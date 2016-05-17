<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

use \Slim\Http\Request;
use \Slim\Http\Response;

/*
 * SETUP
 */

// Requirements
define("WWW_ROOT", dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);    // Composer autoloader
require_once WWW_ROOT . "api" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php';
include WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . "Autoload.php";

// Config
$configuration = [
	'settings' => [
		'displayErrorDetails' => true,
	],
];

// Variables
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

// Override the default Not Found Handler
$c['notFoundHandler'] = function ($c) {
	return function (Request $request, Response $response) use ($c) {
		return $c['response']
			->withStatus(404)
			->withHeader('Content-Type', 'text/html')
			->write('Page not found<br>URI: ' . $request->getUri() . '<br>Request target: ' . $request->getRequestTarget());
	};
};

/*
 * ROUTES
 */

$app->get('/test', function ($request, $response, $args) {
	return $response->withStatus(200)->write('getAll');
});

$app->get('/', function ($request, $response, $args) {
	return $response->withStatus(200)->write('Hello World!');
});

// Walks
$app->group('/walks', function () {
	$this->get("/getAll", 'WalkController:getAll')->setName("getAllWalks");
	$this->get("/getByID/{id:[0-9]+}", 'WalkController:getByID')->setName("getWalkByID");
	$this->post("/add", 'WalkController:add')->setName("addWalk");
	$this->post("/addPOI", 'WalkController:addPOI')->setName("addPOI");
	$this->post("/addWaypoint", 'WalkController:addWaypoint')->setName("addWaypoint");
});

// Themes
$app->group('/themes', function () {
	$this->get("/getAll", 'ThemeController:getAll')->setName("getAllThemes");
	$this->get("/getByID/{id:[0-9]+}", 'ThemeController:getByID')->setName("getThemeByID");
	$this->post("/add", 'ThemeController:add')->setName("addWalk");
});

/*
 * FINISH
 */

// Run Slim
$app->run();