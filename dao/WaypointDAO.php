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

    public static function addWaypoint($languages, $location_id, $media_id) {
        $waypoint_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'media_id'=>$media_id,
            'location_id'=>$location_id
        ));

        WaypointDAO::addExistingMedia($waypoint_id, $media_id);

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

    public static function addMedia($waypoint_id, $languages, $media_type, $media_filename) {
        $media_id = MediaDAO::addMedia($languages, $media_type, $media_filename);
        return WaypointDAO::addExistingMedia($waypoint_id, $media_id);
    }

    public static function addExistingMedia($waypoint_id, $media_id) {
        DAOTemplate::insert(
            MediaDAO::MAPS_TABLE_NAME,
            array(
                'media_id'=>$media_id,
                'stop_type'=>StopTypes::WAYPOINT,
                'stop_id'=>$waypoint_id
            )
        );
        return $media_id;
    }

    public static function getMediaTypeID() {
        return MediaDAO::getMediaTypeIDByName('Photo');
    }
}