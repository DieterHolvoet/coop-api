<?php
/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 13/05/2016
 * Time: 10:15
 */

spl_autoload_register(function ($class_name) {

    require(WWW_ROOT . "api" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php');

    // Class directories
    $directories = array(
        WWW_ROOT . 'classes',
        WWW_ROOT . 'dao',
        WWW_ROOT . 'controllers'
    );

    // Loop through directories
    foreach($directories as $directory) {
        // See if the file exists
        if(file_exists($directory . DIRECTORY_SEPARATOR . $class_name . '.php')) {
            require($directory . DIRECTORY_SEPARATOR . $class_name . '.php');
            return;
        }
    }

});