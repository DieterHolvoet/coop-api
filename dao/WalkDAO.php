<?php

require_once '../classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';

class WalkDAO {
    const TABLE_NAME = 'walks';
    const DETAILS_TABLE_NAME = 'walk_details';
    const MAPS_TABLE_NAME = 'walk_maps';

    public static function getAll() {
        return DAOTemplate::getAll(self::TABLE_NAME, "creation_date");
    }
    
    public static function getWalkByID($walk_id) {
        $data = DAOTemplate::getByID(self::TABLE_NAME, "walk_id", $walk_id)[0];
        if(!empty($data)) $data['translations'] = WalkDAO::getAllTranslations($walk_id);
        return $data;
    }
    
    public static function addWalk($languages, $theme_id, $walk_duration, $walk_distance) {
        if(!filter_var($walk_duration, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>1440)))) {
            throw new Exception('Duration out of range');
        }

        if(!filter_var($walk_distance, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>7000)))) {
            throw new Exception('Walk distance out of range');
        }

        if(!ThemeDAO::getThemeByID($theme_id)) {
            throw new Exception("Theme with ID " . $theme_id . " and type " . gettype($theme_id) . " does not exist.");
        }
        
        $walk_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'theme_id'=>$theme_id,
            'walk_duration'=>$walk_duration,
            'walk_distance'=>$walk_distance,
            'creation_date'=>DAOTemplate::getCurrentDateTime()
        ));

        foreach ($languages as $language_code => $translations) {
            WalkDAO::addTranslation($walk_id, LanguageDAO::getLanguageIDByCode($language_code), $translations['walk_description'], $translations['walk_title']);
        }

        if($walk_id != null){
            return $walk_id;
        } else {
            return false;
        }
    }

    public static function addTranslation($walk_id, $language_id, $walk_description, $walk_title) {
        return DAOTemplate::insert(self::DETAILS_TABLE_NAME, array(
            'walk_id'=>$walk_id,
            'language_id'=>$language_id,
            'walk_description'=>filter_var($walk_description, FILTER_SANITIZE_STRING),
            'walk_title'=>filter_var($walk_title, FILTER_SANITIZE_STRING)
        ));
    }

    public static function getTranslation($walk_id, $language_id) {
        return DAOTemplate::getTranslation(self::DETAILS_TABLE_NAME, 'walk_id', $language_id, $walk_id);
    }

    public static function getAllTranslations($walk_id) {
        $translations = array();
        foreach (LanguageDAO::getAllLanguages() as $language) {
            $translation = WalkDAO::getTranslation($walk_id, $language['language_id']);
            if($translation != null) {
                unset($translation['walk_id']);
                array_push($translations, $translation);
            }
        }
        return $translations;
    }

    public static function addPoi($walk_id, $languages, $location_id) {
        return WalkDAO::addPoiAtPosition($walk_id, $languages, $location_id, WalkDAO::getWalkStopsCount($walk_id) + 1);
    }

    public static function addPoiAtPosition($walk_id, $languages, $location_id, $stop_sequence) {
        $poi_id = PoiDAO::addPoi($languages, $location_id);
        DAOTemplate::executeSQL("UPDATE " . self::MAPS_TABLE_NAME . " SET stop_sequence=stop_sequence+1 WHERE stop_sequence >= " . $stop_sequence, array());
        DAOTemplate::insert(self::MAPS_TABLE_NAME, array(
            'walk_id'=>$walk_id,
            'stop_id'=>$poi_id,
            'stop_type'=>'poi',
            'stop_sequence'=>$stop_sequence
        ));
        return $poi_id;
    }

    public static function addWaypoint($walk_id, $languages, $location_id, $media_id) {
        $waypoint_id = WaypointDAO::addWaypoint($languages, $location_id, $media_id);
        return DAOTemplate::insert(self::MAPS_TABLE_NAME, array(
            'walk_id'=>$walk_id,
            'stop_id'=>$waypoint_id,
            'stop_type'=>'waypoint',
            'stop_sequence'=>WalkDAO::getWalkStopsCount($walk_id) + 1
        ));
    }

    public static function addWaypointAtPosition($walk_id, $languages, $location, $media_id, $stop_sequence) {
        $waypoint_id = WaypointDAO::addWaypoint($languages, $location, $media_id);
        DAOTemplate::executeSQL("UPDATE " . self::MAPS_TABLE_NAME . " SET stop_sequence=stop_sequence+1 WHERE stop_sequence >= " . $stop_sequence, array());
        return DAOTemplate::insert(self::MAPS_TABLE_NAME, array(
            'walk_id'=>$walk_id,
            'stop_id'=>$waypoint_id,
            'stop_type'=>'waypoint',
            'stop_sequence'=>$stop_sequence
        ));
    }
    
    public static function getWalkStopsCount($walk_id) {
        $result = DAOTemplate::executeSQL("SELECT MAX(stop_sequence) AS count FROM " . self::MAPS_TABLE_NAME . " WHERE walk_id = " . $walk_id, array());
        return $result[0]['count'];
    }
}

abstract class StopTypes {
    const POI = 'poi';
    const WAYPOINT = 'waypoint';
}