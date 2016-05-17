<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 14/05/2016
 * Time: 10:15
 */

class UnlockCode {
    public static function generate() {
        $code = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
        if(UnlockCode::exists($code)) {
            return UnlockCode::generate();
        } else {
            return $code;
        }
    }

    public static function exists($code) {
        return !empty(DAOTemplate::getByID("pois", "poi_unlock_code", $code));
    }
}