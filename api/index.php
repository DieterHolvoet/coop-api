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

$c['errorHandler'] = function ($c) {
	return function ($request, $response, $exception) use ($c) {
		$data = [
			'error' => array(
				'code' => $exception->getCode(),
				'message' => $exception->getMessage(),
				'file' => $exception->getFile(),
				'line' => $exception->getLine(),
				'trace' => explode("\n", $exception->getTraceAsString())
			)
		];

		return $c->get('response')->withStatus(500)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($data));
	};
};

$app = new \Slim\App($c);

/*
 * ROUTES
 */

$app->get('/', function ($request, $response, $args) {
	return $response->withStatus(200)->write('<h1>Welcome to the COOP API!</h1><h2>Please refer to the documentation for more information on all endpoints.</h2>');
});

// Walks
$app->group('/walks', function () {
	$this->get("/", 'WalkController:getAll')->setName("getAllWalks");
	$this->post("/", 'WalkController:add')->setName("addWalk");
	$this->group('/{id:[0-9]+}', function () {
		$this->get("/", 'WalkController:getByID')->setName("getWalkByID");
		$this->delete("/", 'WalkController:deleteByID')->setName("deleteWalkByID");
		$this->group('/pois', function () {
			$this->post("/", 'WalkController:addPoiToWalk')->setName("addPoiToWalk");
			$this->get("/", 'WalkController:getPoisByWalkID')->setName("getPoisByWalkID");
		});
		$this->group('/waypoints', function () {
			$this->post("/", 'WalkController:addWaypointToWalk')->setName("addWaypointToWalk");
			$this->get("/", 'WalkController:getWaypointsByWalkID')->setName("getWaypointsByWalkID");
		});
	});
});

// Themes
$app->group('/themes', function () {
	$this->get("/", 'ThemeController:getAll')->setName("getAllThemes");
	$this->get("/{id:[0-9]+}", 'ThemeController:getByID')->setName("getThemeByID");
	$this->post("/", 'ThemeController:add')->setName("addWalk");
});

// Languages
$app->group('/languages', function () {
	$this->get("/", 'LanguageController:getAll')->setName("getAllLanguages");
	$this->get("/{id:[0-9]+}", 'LanguageController:getByID')->setName("getLanguageByID");
	$this->post("/", 'LanguageController:add')->setName("addLanguage");
});

$app->post("/test", 'WalkController:test')->setName("test");

/*
 * FINISH
 */

// Run Slim
$app->run();