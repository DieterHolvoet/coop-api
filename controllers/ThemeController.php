<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 15/05/2016
 * Time: 20:30
 */

class ThemeController {
    public function getAll(Request $request, Response $response) {
        return self::encode(ThemeDAO::getAll($request->getQueryParam('lang')), $response);
    }

    public function getByID(Request $request, Response $response) {
        return self::encode(ThemeDAO::getThemeByID($request->getAttribute('id'), LanguageDAO::getLanguageIDByCode($request->getQueryParam('lang'))), $response);
    }

    public function add(Request $request, Response $response) {
        $data = $request->getParsedBody();

        // Validation
        if(!Verify::color($data['theme_color'])) {
            throw new Exception('Invalid color string');
        }

        return self::encode(array('theme_id'=>ThemeDAO::addTheme($data['translations'], $data['theme_color'])), $response);
    }

    private function encode($data, Response $response) {
        return $response->withHeader('Content-Type', 'application/json')->withJson($data);
    }
}