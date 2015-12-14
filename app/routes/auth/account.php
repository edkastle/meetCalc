<?php

use Carbon\Carbon;

$app->get('/account', $guest(), function() use ($app){
	
	$app->render('auth/account.php');
	
})->name('account');

$app->post('/account', $guest(), function() use ($app){
	
	$app->render('auth/account.php');
	
})->name('account.post');

$app->get('/account/registration', $guest(), function() use ($app){
	
	$app->render('auth/account.php', [
		'tab' => 'regselect'
	]);
	
})->name('account.register');