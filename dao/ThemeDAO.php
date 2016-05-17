<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 13/05/2016
 * Time: 10:07
 */

require_once '../classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';

class ThemeDAO {
    const TABLE_NAME = 'themes';
    const DETAILS_TABLE_NAME = 'theme_details';

    public static function getThemeByID($theme_id) {
        $data = DAOTemplate::getByID(self::TABLE_NAME, "theme_id", $theme_id)[0];
        if(!empty($data)) {
            $data['translations'] = ThemeDAO::getAllTranslations($theme_id);
        }
        return $data;
    }

    public static function getThemeByName($language_code, $theme_name) {
        $theme = DAOTemplate::getWhere(self::DETAILS_TABLE_NAME, array('theme_name'=>$theme_name, 'language_id'=>LanguageDAO::getLanguageIDByCode($language_code)));
        if(count($theme) > 0) {
            return ThemeDAO::getThemeByID($theme[0]['theme_id']);
        } else {
            throw new Exception('Theme with name ' . $theme_name . ' not found.');
            return false;
        }
    }

    public static function getAll($language_code) {
        $themes = DAOTemplate::getAll(self::TABLE_NAME, "theme_id");

        for($i = 0; $i < count($themes); $i++) {
            $themes[$i]['theme_name'] = ThemeDAO::getTranslation($themes[$i]['theme_id'], LanguageDAO::getLanguageIDByCode($language_code))['theme_name'];
        }

        return $themes;
    }

    public static function addTheme($languages, $theme_color){
        $theme_id = DAOTemplate::insert(self::TABLE_NAME, array(
            'theme_color'=>$theme_color,
        ));
        foreach ($languages as $language_code => $translations) {
            ThemeDAO::addTranslation($theme_id, LanguageDAO::getLanguageIDByCode($language_code), $translations['theme_name']);
        }

        if($theme_id != null){
            return $theme_id;
        } else {
            return false;
        }
    }

    public static function addTranslation($theme_id, $language_id, $theme_name) {
        return DAOTemplate::insert(self::DETAILS_TABLE_NAME, array(
            'theme_id'=>$theme_id,
            'language_id'=>$language_id,
            'theme_name'=>$theme_name));
    }

    public static function getTranslation($theme_id, $language_id) {
        return DAOTemplate::getTranslation(self::DETAILS_TABLE_NAME, "theme_id", $language_id, $theme_id);
    }

    public static function getAllTranslations($theme_id) {
        $translations = array();
        foreach (LanguageDAO::getAllLanguages() as $language) {
            $translation = ThemeDAO::getTranslation($theme_id, $language['language_id']);
            if($translation != null) {
                unset($translation['theme_id']);
                unset($translation['theme_detail_id']);
                array_push($translations, $translation);
            }
        }
        return $translations;
    }
}