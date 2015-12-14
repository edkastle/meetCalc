<?php

//all meetings
$app->get('/meeting', $authenticated(), function() use ($app){
	
	$meetings = $app->meeting
		->where('user_id', '=', $app->auth->id)
		->orderBy('created_at', 'desc')
	->get();
	
	$app->render('meetings/meetings.php', [
		'meetings' => $meetings
	]);
	
})->name('meetings');

$app->get('/delmeet/:meet', $authenticated(), function($meet) use ($app){
	
	$deleted = $app->meeting
		->where('id', '=', $meet)
	->delete();
	
	$meetings = $app->meeting
		->where('user_id', '=', $app->auth->id)
		->orderBy('created_at', 'desc')
	->get();
	
	$app->response->redirect($app->urlFor('meetings'));
	
})->name('delete.meet');

//a meeting
$app->get('/meeting/:meet', $authenticated(), function($meet) use ($app){
	
	$meeting = $app->meeting
		->where('id', '=', $meet)
		->take(1)
	->get()->first();
	
	if(count($meeting) <= 0){
		$app->response->redirect($app->urlFor('home'));
	}
	
	$time = [
		"timer" => 0,
		"end" => $meeting->end_time
	];
	
	if($meeting->start_time != null){
		$time["timer"] = time() - $meeting->start_time;
		$time["timerH"] = (string)floor(abs($time["timer"] / 3600));
		$time["timerM"] = (string)floor(abs(abs($time["timer"]) - abs($time["timerH"] * 3600)) / 60);
		$time["timerS"] = (string)abs($time["timer"]) - (($time["timerH"] * 3600) + ($time["timerM"] * 60));
		
		if(strlen($time["timerH"]) == 1){
			$time["timerH"] = '0'. $time["timerH"];
		} if(strlen($time["timerM"]) == 1){
			$time["timerM"] = '0'. $time["timerM"];
		} if(strlen($time["timerS"]) == 1){
			$time["timerS"] = '0'. $time["timerS"];
		}
		
	} else {
		$time["timerH"] = 00;
		$time["timerM"] = 00;
		$time["timerS"] = 00;
	}
	
	$attendees = $app->attendees
		->join('users', 'users.id', '=', 'attendees.user_id')
		->where('attendees.meet_id', '=', $meeting->id)
		
		->select(
			'users.id as id',
			'users.first_name as first',
			'users.last_name as last',
			'users.wage as wage'
		)
		
		->orderBy('users.last_name', 'asc')
		
	->get();
	
	$wasted = [
		'wage' => 0,
		'waste' => 0
	];
	
	foreach($attendees as $att){
		$wasted['wage'] += $att->wage;
	}
	
	if($time['timer'] > 0){
		$wasted['waste'] = number_format(round($time['timer'] * ($wasted['wage'] / 60), 2), 2, ".", "");
	}

	$app->render('meetings/meet.php', [
		'meeting' => $meeting,
		'attendees' => $attendees,
		'time' => $time,
		'wasted' => $wasted
	]);
	
})->name('meeting');

//edit meeting
$app->get('/meeting/:meet/edit', $authenticated(), function($meet) use ($app){
	
	$meeting = $app->meeting
		->where('id', '=', $meet)
		->where('user_id', '=', $app->auth->id)
		->take(1)
	->get()->first();
	
	if(count($meeting) <= 0){
		$app->response->redirect($app->urlFor('home'));
	}
	
	$attendees = $app->attendees
		->join('users', 'users.id', '=', 'attendees.user_id')
		->where('attendees.meet_id', '=', $meeting->id)
		
		->select(
			'users.id as id',
			'users.first_name as first',
			'users.last_name as last',
			'users.wage as wage'
		)
		
		->orderBy('users.last_name', 'asc')
		
	->get();
	
	$app->render('meetings/editmeeting.php', [
		'meeting' => $meeting,
		'attendees' => $attendees
	]);
	
})->name('meeting.edit');

$app->post('/meeting/:meet/edit', $authenticated(), function($meet) use ($app){
	
	$request = $app->request;
	$name = $request->post('name');
	$startHour = $request->post('start_hour');
	$startMin = $request->post('start_minute');
	$startTime = strtolower($request->post('start_time'));
	
	$endHour = $request->post('end_hour');
	$endMin = $request->post('end_minute');
	$endTime = strtolower($request->post('end_time'));
	
	$v = $app->validation;
	$v->validate([
		'Name' => [$name, 'required|max(50)'],
		
		'sHour' => [$startHour, 'int|between(1,12)'],
		'sMin' => [$startMin, 'int|between(0,59)'],
		
		'eHour' => [$endHour, 'int|between(1,12)'],
		'eMin' => [$endMin, 'int|between(0,59)'],
		
		'sHour2' => [$startHour, 'required'],
		'sMin2' => [$startMin, 'required'],
		
		'eHour2' => [$endHour, 'required'],
		'eMin2' => [$endMin, 'required']
	]);
	
	if($startTime != 'am'){
		$startTime = 'pm';
	} if($endTime != 'am'){
		$endTime = 'pm';
	}
	
	if(strlen($startHour) == 1){
		$startHour = '0'. $startHour;
	} if(strlen($endHour) == 1){
		$endHour = '0'. $endHour;
	}
	
	if(strlen($startMin) == 1){
		$startMin = '0'. $startMin;
	} if(strlen($endMin) == 1){
		$endMin = '0'. $endMin;
	}
	
	$meeting = $app->meeting
		->where('id', '=', $meet)
		->where('user_id', '=', $app->auth->id)
		->take(1)
	->get()->first();
	
	if(count($meeting) <= 0){
		$app->response->redirect($app->urlFor('home'));
	}
	
	$start = null;
	$end   = null;
	
	$e = $v->errors();
		
	if($e->has('Name')){
		$name = $meeting->name;
	}
	
	if(!$e->has('sHour2') || !$e->has('sMin2')){
		if($e->has('sHour2') || $e->has('sMin2')){
			$start = $meeting->start_time;
		} else if(!$e->has('sHour') && !$e->has('sMin')){
			$starting = strtotime($startHour .':'. $startMin .' '. $startTime);
			$starting = strtotime(date('H:i', $starting) .':00');
			$start = strtotime(
				date('Y:m:d', time()) .' '.
				date('H:i:s', $starting)
			);
		} else {
			$start = $meeting->start_timer;
		}
	}

	if(!$e->has('eHour2') || !$e->has('eMin2')){
		if($e->has('eHour2') || $e->has('eMin2')){
			$end = $meeting->end_time;
		} else if(!$e->has('eHour') && !$e->has('eMin')){
			$ending = strtotime($endHour .':'. $endMin .' '. $endTime);
			$ending = strtotime(date('H:i', $ending) .':00');
			$end = strtotime(
				date('Y:m:d', time()) .' '.
				date('H:i:s', $ending)
			);
		} else {
			$end = $meeting->end_time;
		}
	}
	
	if($end != null && $start != null){
		if($end <= $start){
			$end = strtotime('+1 day', $end);
		}
	}
	
	$meeting->update([
		'name' => $name,
		'start_time' => $start,
		'end_time' => $end
	]);
	
	$attendees = $app->attendees
		->join('users', 'users.id', '=', 'attendees.user_id')
		->where('attendees.meet_id', '=', $meeting->id)
		
		->select(
			'users.id as id',
			'users.first_name as first',
			'users.last_name as last',
			'users.wage as wage'
		)
		
		->orderBy('users.last_name', 'asc')
		
	->get();
	
	$app->render('meetings/editmeeting.php', [
		'meeting' => $meeting,
		'attendees' => $attendees
	]);
	
})->name('meeting.edit.post');

//new meeting
$app->get('/meeting/edit/new', $authenticated(), function() use ($app){
	$app->render('meetings/newmeeting.php');
	
})->name('meeting.new');

//post new meeting
$app->post('/meeting/edit/new', $authenticated(), function() use ($app){
	
	$request = $app->request;
	$name = $request->post('name');
	
	$v = $app->validation;
	$v->validate([
		'Name' => [$name, 'required|max(50)']
	]);
	
	if($v->passes()){
		$meeting = $app->meeting->create([
			'name' => $name,
			'user_id' => $app->auth->id
		]);
		
		return $app->response->redirect($app->urlFor('meeting.edit', array("meet" => $meeting->id)));
	}

	$app->render('meetings/newmeeting.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);
	
})->name('meeting.new.post');

$app->get('/getpeople', function() use ($app){
	
	$results = '';
	
	$request = $app->request;
	$searchQuery = $request->get('person');
	
	$v = $app->validation;
	$v->validate([
		'Person' => [$searchQuery, 'required']
	]);
	
	if($v->passes()){
		
		$user = $app->user
			->where('username', 'LIKE', "%$searchQuery%")
			->orWhere('first_name', 'LIKE', "%$searchQuery%")
			->orWhere('last_name', 'LIKE', "%$searchQuery%")
			->select(
				'id',
				'first_name as first',
				'last_name as last',
				'wage'
			)
			->orderBy('last_name', 'asc')
			->take(10)
			->get()
		;
		
		if($user){
			$results = $user;
		}
	}
	
	echo json_encode($results);
	
})->name('meeting.getpeople');

$app->get('/getattendees', function() use ($app){
	
	$results = '';
	
	$request = $app->request;
	$meetid = $request->get('meetid');
	
	$v = $app->validation;
	$v->validate([
		'meet_id' => [$meetid, 'required']
	]);
	
	if($v->passes()){
		
		$meet = $app->attendees
			->join('users', 'users.id', '=', 'attendees.user_id')
			->where('attendees.meet_id', '=', $meetid)
			
			->select(
				'users.id as id',
				'users.first_name as first',
				'users.last_name as last',
				'users.wage as wage'
			)
			
			->orderBy('users.last_name', 'asc')
			
		->get();
		
		if(count($meet) > 0){
			$results = $meet;
		} else {
			$results = 'empty';
		}
	}
	
	echo json_encode($results);
	
})->name('meeting.getattendants');

$app->get('/addattendees', function() use ($app){
	
	$request = $app->request;
	
	$userid = $request->get('userid');
	$meetid = $request->get('meetid');
	
	$v = $app->validation;
	$v->validate([
		'userid' => [$userid, 'required'],
		'meetid' => [$meetid, 'required']
	]);
	
	if($v->passes()){
		
		$searchatt = $app->attendees
			->where('meet_id', '=', $meetid)
			->where('user_id', '=', $userid)
			->limit(1)
		->get();
		
		if(count($searchatt) <= 0){
		
			$meeting = $app->attendees->create([
				'meet_id' => $meetid,
				'user_id' => $userid
			]);
		
		}
		
	}
	
})->name('meeting.addpeople');

$app->get('/removeattendees', function() use ($app){
	
	$request = $app->request;
	
	$userid = $request->get('userid');
	$meetid = $request->get('meetid');
	
	$v = $app->validation;
	$v->validate([
		'userid' => [$userid, 'required'],
		'meetid' => [$meetid, 'required']
	]);
	
	if($v->passes()){
		
		$searchatt = $app->attendees
			->where('meet_id', '=', $meetid)
			->where('user_id', '=', $userid)
		->delete();
			
	}
	
})->name('meeting.removeattendees');