<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 15/05/2016
 * Time: 20:12
 */

class WalkController
{
    public static function getAll(Request $request, Response $response) {
        return self::encode(WalkDAO::getAll($request->getQueryParam('lang')), $response);
    }

    public static function getByID(Request $request, Response $response) {
        return self::encode(WalkDAO::getWalkByID($request->getAttribute('id'), LanguageDAO::getLanguageIDByCode($request->getQueryParam('lang')), $request->getQueryParam('grouped')), $response);
    }

    public static function add(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $walk_id = WalkDAO::addWalk($data['translations'], $data['theme_id'], $data['walk_duration'], $data['walk_distance']);

        if(isset($data['stops'])) {
            foreach ($data['stops'] as $stop) {
                $location_id = LocationDAO::addLocation($stop['location']['translations'], $stop['location']['location_lat'], $stop['location']['location_lon'], (int) $stop['location']['location_house_number'], $stop['location']['location_postal_code']);

                if($stop['stop_type'] == StopTypes::POI) {
                    $poi_id = WalkDAO::addPoi($walk_id, $stop['translations'], $location_id);

                    if(isset($stop['media'])) {
                        foreach($stop['media'] as $media) {
                            PoiDAO::addMedia($poi_id, $media['translations'], MediaDAO::getMediaTypeIDByName($media['media_type_name']), $media['media_filename']);
                        }
                    }

                } else if($stop['stop_type'] == StopTypes::WAYPOINT) {
                    $media_id = MediaDAO::addMedia(array(), WaypointDAO::getMediaTypeID(), $stop['media_filename']);
                    WalkDAO::addWaypoint($walk_id, $stop['translations'], $location_id, $media_id);
                }
            }
        }

        return self::encode(array('walk_id'=>$walk_id), $response);
    }

    public static function addPOI(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $location_id = LocationDAO::addLocation($data['location']['translations'], $data['location']['location_lat'], $data['location']['location_lon'], (int) $data['location']['location_house_number'], $data['location']['location_postal_code']);
        $poi_id = false;

        if(isset($data['stop_sequence'])) {
            $poi_id = WalkDAO::addPoiAtPosition($data['walk_id'], $data['translations'], $location_id, $data['stop_sequence']);
        } else {
            $poi_id = WalkDAO::addPoi($data['walk_id'], $data['translations'], $location_id);
        }

        return self::encode(array('poi_id'=>$poi_id), $response);
    }

    public static function addWaypoint(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $location_id = LocationDAO::addLocation($data['location']['translations'], $data['location']['location_lat'], $data['location']['location_lon'], (int) $data['location']['location_house_number'], $data['location']['location_postal_code']);
        $media_id = MediaDAO::addMedia(array(), WaypointDAO::getMediaTypeID(), $data['media_filename']);
        $waypoint_id = false;

        if(isset($data['stop_sequence'])) {
            $waypoint_id = WalkDAO::addWaypointAtPosition($data['walk_id'], $data['translations'], $location_id, $media_id, $data['stop_sequence']);
        } else {
            $waypoint_id = WalkDAO::addWaypoint($data['walk_id'], $data['translations'], $location_id, $media_id);
        }

        return self::encode(array('waypoint_id'=>$waypoint_id), $response);
    }

    private static function encode($data, Response $response) {
        return $response->withHeader('Content-Type', 'application/json')->withJson($data);
    }
}