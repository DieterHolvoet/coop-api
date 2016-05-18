<?php
/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 17/05/2016
 * Time: 11:35
 */

// Requirements
define("WWW_ROOT", dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);    // Composer autoloader
require_once WWW_ROOT . "api" . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php';
include WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . "Autoload.php";

// Test
echo json_encode(ThemeDAO::getTranslation(1, 1));