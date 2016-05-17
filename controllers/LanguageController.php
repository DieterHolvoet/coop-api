<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 17/05/2016
 * Time: 14:40
 */
class LanguageController
{
    public static function getAll(Request $request, Response $response) {
        return self::encode(LanguageDAO::getAllLanguages(), $response);
    }

    public static function getByID(Request $request, Response $response) {
        return self::encode(LanguageDAO::getLanguageByID($request->getAttribute('id'))[0], $response);
    }

    public function add(Request $request, Response $response) {
        $data = $request->getParsedBody();
        return self::encode(array('language_id'=>LanguageDAO::addLanguage($data['language_code'], $data['language_name'])), $response);
    }

    private static function encode($data, Response $response) {
        return $response->withHeader('Content-Type', 'application/json')->withJson($data);
    }
}