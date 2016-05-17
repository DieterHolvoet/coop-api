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

/*
 * ROUTES
 */

$app->get('/', function ($request, $response, $args) {
	return $response->withStatus(200)->write('<h1>Welcome to the COOP API!</h1><h2>Please refer to the documentation for more information on all endpoints.</h2>');
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

// Languages
$app->group('/languages', function () {
	$this->get("/getAll", 'LanguageController:getAll')->setName("getAllLanguages");
	$this->get("/getByID/{id:[0-9]+}", 'LanguageController:getByID')->setName("getLanguageByID");
	$this->post("/add", 'LanguageController:add')->setName("addLanguage");
});

/*
 * FINISH
 */

// Run Slim
$app->run();