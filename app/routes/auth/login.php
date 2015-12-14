<?php

use Carbon\Carbon;

$app->get('/login', $guest(), function() use ($app){
	
	$app->render('auth/login.php');
	
})->name('login');

$app->post('/login', $guest(), function() use ($app){
	
	$request = $app->request;
	
	$identifier = $request->post('identifier');
	$password = $request->post('password');
	
	$v = $app->validation;
	
	$v->validate([
		'Username' => [$identifier, 'required'],
		'Password' => [$password, 'required']
	]);
	
	if($v->passes()){
		
		$user = $app->user
			->where('username', $identifier)
		->first();
			
		if($user && $app->hash->passwordCheck($password, $user->password)){		
			$_SESSION[$app->config->get('auth.session')] = $user->id;
			
			$app->flash('global', 'You are now signed in!');
			return $app->response->redirect($app->urlFor('home'));
		} else {
			$app->flash('login', 'Username or password is incorrect');
			return $app->response->redirect(($app->urlFor('login')));
		}
	}
	
	$app->render('auth/login.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);
	
})->name('login.post');