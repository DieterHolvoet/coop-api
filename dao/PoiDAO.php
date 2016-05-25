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

    /*
     * ADD
     */

    public static function addPoi($languages, $location_id) {
        $poi_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'poi_unlock_code'=>PoiDAO::generateUnlockCode(),
            'location_id'=>$location_id
        ));

        foreach ($languages as $language_code => $translations) {
            PoiDAO::addTranslation($poi_id, LanguageDAO::getLanguageIDByCode($language_code), $translations['poi_description'], $translations['poi_title']);
        }

        if($poi_id != null) {
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
        return MediaDAO::addMedia(StopTypes::POI, $poi_id, $languages, $media_type_id, $media_filename);
    }

    /*
     * GET
     */

    public static function getPoiByID($poi_id) {
        return DAOTemplate::getByID(self::TABLE_NAME, 'poi_id', $poi_id);
    }

    public static function getTranslation($poi_id, $language_id) {
        return DAOTemplate::getTranslation(self::DETAILS_TABLE_NAME, 'poi_id', $language_id, $poi_id);
    }

    public static function getMedia($poi_id, $language_id) {
        return MediaDAO::getMediaWithTranslation(StopTypes::POI, $poi_id, $language_id);
    }

    /*
     * DELETE
     */
    
    public static function deletePoiByID($poi_id) {
        return DAOTemplate::deleteByID(self::TABLE_NAME, 'poi_id', $poi_id);
    }

    public static function deleteTranslation($poi_detail_id) {
        return DAOTemplate::deleteByID(self::DETAILS_TABLE_NAME, 'poi_detail_id', $poi_detail_id);
    }

    public static function deleteTranslationsByPoiID($poi_id) {
        return DAOTemplate::deleteByID(self::DETAILS_TABLE_NAME, 'poi_id', $poi_id);
    }

    /*
     * HELPER
     */

    // Source: http://stackoverflow.com/a/4571347
    public static function generateUnlockCode() {
        return substr(md5(uniqid(mt_rand(), true)) , 0, 8);
    }

    public static function getAmountOfWalksUsedIn($poi_id) {
        // TO DO
    }
}