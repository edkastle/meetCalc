<?php

namespace root\Meetings;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Meeting extends Eloquent{
	protected $table = 'meetings';
	
	protected $fillable = [
		'user_id',
		'name',
		'active',
		'start_time',
		'end_time'
	];
	
}