<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 15/05/2016
 * Time: 20:30
 */

class ThemeController
{
    public function getAll(Request $request, Response $response) {
        return self::encode(ThemeDAO::getAll($request->getQueryParam('lang')), $response);
    }

    public function getByID(Request $request, Response $response) {
        return self::encode(ThemeDAO::getThemeByID($request->getAttribute('id')), $response);
    }

    public function add(Request $request, Response $response) {
        // Variables
        $data = $request->getParsedBody();
        $duration = (int) $data['theme_color'];
        $distance = (int) $data['theme_name'];
        $theme_id = (int) $data['theme_id'];
        $description = filter_var($data['walk_description'], FILTER_SANITIZE_STRING);
        $title = filter_var($data['walk_title'], FILTER_SANITIZE_STRING);

        // Validation
        if(strlen($request->getBody()) == 0) {
            throw new Exception('Error fetching request body.' . count($data));
        }

        if(!filter_var($duration, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>1440)))) {
            throw new Exception('Duration out of range');
        }

        if(!filter_var($distance, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>7000)))) {
            throw new Exception('Walk distance out of range');
        }

        if(!ThemeDAO::getThemeByID($theme_id)) {
            throw new Exception("Theme with ID " . $theme_id . " and type " . gettype($theme_id) . " does not exist.");
        }

        return self::encode(WalkDAO::addWalk($duration, $distance, $theme_id, $description, $title), $response);
    }

    private function encode($data, Response $response) {
        return $response->withHeader('Content-Type', 'application/json')->withJson($data);
    }
}