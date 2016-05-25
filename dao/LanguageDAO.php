<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 13/05/2016
 * Time: 11:58
 */
class LanguageDAO {
    const TABLE_NAME = 'languages';

    /*
     * ADD
     */

    public static function addLanguage($language_code, $language_name) {
        if(!Verify::languageCode($language_code)) throw new Exception('Invalid language code.');
        return DAOTemplate::insert(self::TABLE_NAME, array('language_code'=>$language_code, 'language_name'=>$language_name));
    }

    /*
     * GET
     */

    public static function getAllLanguages(){
        return DAOTemplate::getAll(self::TABLE_NAME, 'language_name');
    }

    public static function getLanguageByID($language_id){
        return DAOTemplate::getByID("languages", "language_id", $language_id);
    }

    public static function getLanguageByCode($language_code){
        return DAOTemplate::getByID("languages", "language_code", $language_code);
    }

    public static function getLanguageIDByCode($language_code){
        return DAOTemplate::getByID("languages", "language_code", $language_code)[0]['language_id'];
    }

    /*
     * DELETE
     */

    public static function deleteLanguage($language_id) {
        return DAOTemplate::deleteByID(self::TABLE_NAME, 'language_id', $language_id);
    }

    /*
     * HELPER
     */
}