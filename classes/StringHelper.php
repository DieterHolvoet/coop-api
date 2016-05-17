<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 17/05/2016
 * Time: 10:42
 */
class StringHelper
{

    // Source: http://stackoverflow.com/a/10473026
    // Search backwards starting from haystack length characters from the end
    public static function startsWith($haystack, $needle) {
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    // Source: http://stackoverflow.com/a/10473026
    // Search forward starting from end minus needle length characters
    public static function endsWith($haystack, $needle) {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }
}