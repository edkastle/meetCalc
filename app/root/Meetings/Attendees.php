<?php

namespace root\Meetings;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Attendees extends Eloquent{
	protected $table = 'attendees';
	
	protected $fillable = [
		'meet_id',
		'user_id'
	];
	
}