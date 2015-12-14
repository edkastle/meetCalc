<?php

$app->get('/', function() use ($guest, $app){


	if($app->auth){
		$app->response->redirect($app->urlFor('meetings'));
	} else {
		$app->response->redirect($app->urlFor('login'));
	}
	
//	$app->render('home.php');
	
})->name('home');