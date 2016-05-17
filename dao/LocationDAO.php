<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 15/05/2016
 * Time: 11:51
 */

class LocationDAO {
    const TABLE_NAME = 'locations';
    const DETAILS_TABLE_NAME = 'location_details';

    public static function addLocation($languages, $location_lat, $location_lon, $location_house_number, $location_postal_code) {
        $location_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'location_lat'=>$location_lat,
            'location_lon'=>$location_lon,
            'location_house_number'=>$location_house_number,
            'location_postal_code'=>$location_postal_code
        ));

        foreach ($languages as $language_code => $translations) {
            LocationDAO::addTranslation($location_id, LanguageDAO::getLanguageIDByCode($language_code), $translations['location_street'], $translations['location_city']);
        }

        if($location_id != null){
            return $location_id;
        } else {
            return false;
        }
    }

    public static function addTranslation($location_id, $language_id, $location_street, $location_city) {
        return DAOTemplate::insert(self::DETAILS_TABLE_NAME, array(
            'location_id'=>$location_id,
            'language_id'=>$language_id,
            'location_street'=>$location_street,
            'location_city'=>$location_city
        ));
    }
}