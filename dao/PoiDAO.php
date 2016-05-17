<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 13/05/2016
 * Time: 16:52
 */

class PoiDAO {
    const TABLE_NAME = 'pois';
    const DETAILS_TABLE_NAME = 'poi_details';

    public static function addPoi($languages, $location_id) {
        $poi_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'poi_unlock_code'=>PoiDAO::generateUnlockCode(),
            'location_id'=>$location_id
        ));
        
        foreach ($languages as $language_code => $translations) {
            PoiDAO::addTranslation($poi_id, LanguageDAO::getLanguageIDByCode($language_code), $translations['poi_description'], $translations['poi_title']);
        }

        if($poi_id != null){
            return $poi_id;
        } else {
            return false;
        } 
    }

    public static function addTranslation($poi_id, $language_id, $poi_description, $poi_title) {
        return DAOTemplate::insert(self::DETAILS_TABLE_NAME, array(
            'poi_id'=>$poi_id,
            'language_id'=>$language_id,
            'poi_description'=>$poi_description,
            'poi_title'=>$poi_title
        ));
    }

    public static function addMedia($poi_id, $languages, $media_type_id, $media_filename) {
        $media_id = MediaDAO::addMedia($languages, $media_type_id, $media_filename);
        return PoiDAO::addExistingMedia($poi_id, $media_id);
    }

    public static function addExistingMedia($poi_id, $media_id) {
        DAOTemplate::insert(
            MediaDAO::MAPS_TABLE_NAME,
            array(
                'media_id'=>$media_id,
                'stop_type'=>StopTypes::POI,
                'stop_id'=>$poi_id
            )
        );
        return $media_id;
    }

    // Source: http://stackoverflow.com/a/4571347
    public static function generateUnlockCode() {
        $unlock_code = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
        $results = DAOTemplate::getByID(self::TABLE_NAME, 'poi_unlock_code', $unlock_code);
        if(empty($results)) {
            return $unlock_code;
        } else {
            return PoiDAO::generateUnlockCode();
        }
    }
}