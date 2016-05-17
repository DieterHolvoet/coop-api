<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 17/05/2016
 * Time: 13:33
 */
class Verify
{
    // Source: http://stackoverflow.com/a/10473026
    // Search backwards starting from haystack length characters from the end
    public static function stringStartsWith($haystack, $needle) {
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    // Source: http://stackoverflow.com/a/10473026
    // Search forward starting from end minus needle length characters
    public static function stringEndsWith($haystack, $needle) {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

    // Source: https://code.hyperspatial.com/all-code/php-code/verify-hex-color-string/
    // Verify a hex color string
    public static function color($color) {
        if (Verify::stringStartsWith($color, '#')) {
            return !!preg_match('/^#[a-f0-9]{6}$/i', $color);
        } else {
            return !!preg_match('/^[a-f0-9]{6}$/i', $color);
        }
    }
}