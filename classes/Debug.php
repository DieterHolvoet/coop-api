<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 15/05/2016
 * Time: 15:34
 */
class Debug {
    public static function printArray($array) {
        /*echo gettype($array);
        foreach ($array as $key => $value) {
            echo "Key: $key; Value: $value\n";
        }*/
        echo json_encode($array);
    }
}