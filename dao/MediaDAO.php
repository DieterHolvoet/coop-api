<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 14/05/2016
 * Time: 10:27
 */

class MediaDAO {
    const TABLE_NAME = 'media';
    const DETAILS_TABLE_NAME = 'media_details';
    const TYPES_TABLE_NAME = 'media_types';
    const MAPS_TABLE_NAME = 'media_maps';

    public static function addMedia($languages, $media_type_id, $media_filename) {
        $media_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'media_type_id'=>$media_type_id,
            'media_filename'=>$media_filename
        ));

        foreach ($languages as $language_code => $translations) {
            MediaDAO::addTranslation($media_id, LanguageDAO::getLanguageIDByCode($language_code), $translations['media_description'], $translations['media_title']);
        }

        if($media_id != null){
            return $media_id;
        } else {
            return false;
        }
    }

    public static function addMediaType($media_type_name, $media_type_path) {
        return DAOTemplate::insert(self::TYPES_TABLE_NAME, array('media_type_name'=>$media_type_name, 'media_type_path'=>$media_type_path));
    }

    public static function getMediaTypeByName($media_type_name) {
        return DAOTemplate::getByID(self::TYPES_TABLE_NAME, 'media_type_name', $media_type_name);
    }

    public static function getMediaTypeIDByName($media_type_name) {
        return DAOTemplate::getByID(self::TYPES_TABLE_NAME, 'media_type_name', $media_type_name)[0]['media_type_id'];
    }

    public static function getMediaTypeByID($media_type_id) {
        return DAOTemplate::getByID(self::TYPES_TABLE_NAME, 'media_type_id', $media_type_id)[0];
    }

    public static function addTranslation($media_id, $language_id, $media_description, $media_title) {
        return DAOTemplate::insert(self::DETAILS_TABLE_NAME, array(
            'media_id'=>$media_id,
            'language_id'=>$language_id,
            'media_description'=>$media_description,
            'media_title'=>$media_title
        ));
    }

    public static function getTranslation($media_id, $language_id) {
        return DAOTemplate::getTranslation(self::DETAILS_TABLE_NAME, 'media_id', $language_id, $media_id);
    }

    public static function getMedia($stop_type, $stop_id, $language_id) {
        $media = DAOTemplate::executeSQL('SELECT a.media_id, a.media_filename, d.media_title, d.media_description, c.media_type_id 
                                                    FROM '. MediaDAO::TABLE_NAME .' a 
                                                    INNER JOIN '. MediaDAO::MAPS_TABLE_NAME .' b ON a.media_id = b.media_id
                                                    INNER JOIN '. MediaDAO::TYPES_TABLE_NAME .' c ON a.media_type_id = c.media_type_id
                                                    INNER JOIN '. MediaDAO::DETAILS_TABLE_NAME .' d ON a.media_id = d.media_id
                                                    WHERE b.stop_type = :stop_type AND stop_id = :stop_id AND language_id = :language_id',
            array('stop_type'=>$stop_type, 'stop_id'=>$stop_id, 'language_id'=>$language_id));

        for($i = 0; $i < count($media); $i++) {
            $media[$i]['media_url'] = MediaDAO::getMediaURL($media[$i]['media_filename'], $media[$i]['media_type_id']);
            unset($media[$i]['media_filename']);
        }

        return $media;
    }

    public static function getMediaURL($media_filename, $media_type_id) {
        $media_type_path = MediaDAO::getMediaTypeByID($media_type_id)['media_type_path'];
        return Config::MEDIA_URL . DIRECTORY_SEPARATOR . $media_type_path . DIRECTORY_SEPARATOR . $media_filename;
    }
}