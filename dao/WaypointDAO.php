<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 13/05/2016
 * Time: 21:25
 */
class WaypointDAO {
    const TABLE_NAME = 'waypoints';
    const DETAILS_TABLE_NAME = 'waypoint_details';

    public static function getWaypointByID($waypoint_id) {
        return DAOTemplate::getByID(self::TABLE_NAME, 'waypoint_id', $waypoint_id);
    }

    public static function addWaypoint($languages, $location_id) {
        $waypoint_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'location_id'=>$location_id
        ));

        foreach ($languages as $language_code => $translations) {
            WaypointDAO::addTranslation($waypoint_id, LanguageDAO::getLanguageIDByCode($language_code), $translations['waypoint_description']);
        }

        if($waypoint_id != null){
            return $waypoint_id;
        } else {
            return false;
        }
    }

    public static function addTranslation($waypoint_id, $language_id, $waypoint_description) {
        return DAOTemplate::insert(self::DETAILS_TABLE_NAME, array(
            'waypoint_id'=>$waypoint_id,
            'language_id'=>$language_id,
            'waypoint_description'=>$waypoint_description
        ));
    }

    public static function getTranslation($waypoint_id, $language_id) {
        return DAOTemplate::getTranslation(self::DETAILS_TABLE_NAME, 'waypoint_id', $language_id, $waypoint_id);
    }

    public static function addMedia($waypoint_id, $media_filename) {
        return MediaDAO::addMedia(StopTypes::WAYPOINT, $waypoint_id, array(), WaypointDAO::getMediaTypeID(), $media_filename);
    }

    public static function getMedia($waypoint_id) {
        return MediaDAO::getMedia(StopTypes::WAYPOINT, $waypoint_id);
    }

    public static function getMediaTypeID() {
        return MediaDAO::getMediaTypeIDByName('Photo');
    }
}