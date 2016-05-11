<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

define("WWW_ROOT",dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);

require_once WWW_ROOT. "dao" .DIRECTORY_SEPARATOR. 'PloegenDAO.php';
require_once WWW_ROOT. "dao" .DIRECTORY_SEPARATOR. 'DeelnemersDAO.php';

require_once WWW_ROOT. "api" .DIRECTORY_SEPARATOR. 'Slim'. DIRECTORY_SEPARATOR .'Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$voorbeeldDAO = new VoorbeeldDAO();

$app->get("/ploegen/getAll/?", function() use ($app, $voorbeeldDAO){

	header("Content-Type:application/json");
	echo json_encode($ploegenDAO->getAllPloegen());
	exit();

});

$app->post("/ploegen/add/?", function() use ($app, $voorbeeldDAO){

	header("Content-Type:application/json");
	$post = $app->request->post();
	if(empty($post)){
		$post = (array) json_decode($app->request()->getBody());
	}
    $team_naam = $post['team-naam'];
    $ver_naam = $post['verantwoordelijke-naam'];
    $ver_mail = $post['verantwoordelijke-mail'];
    $ver_gsm = $post['verantwoordelijke-gsm'];
    echo json_encode($ploegenDAO->addPloeg($team_naam,$ver_naam,$ver_mail,$ver_gsm));
    exit();

});

$app->run();