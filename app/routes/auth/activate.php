<?php

$app->get('/activate', $guest(), function() use($app){
	
	$request = $app->request;
	
	$email = $request->get('email');
	$identifier = $request->get('identifier');
	
	$hashedIdentifier = $app->hash->hash($identifier);
	
	$user = $app->user->where('email', $email)
		->where('active', false)
		->first();
		
	if(!$user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier)){
		$app->flash('global', 'There was a problem activating your account.');
	} else {
		$user->activateAccount();
		$app->flash('login', 'Your account has been activated, you can now sign in.');
	}
	return $app->response->redirect($app->urlFor('login'));
	
})->name('activate');