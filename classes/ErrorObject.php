<?php

/**
 * Created by PhpStorm.
 * User: Dieter
 * Date: 19/05/2016
 * Time: 18:57
 */
class ErrorObject {

    public $message;
    public $json;

    function __construct($_message) {
        $this->message = $_message;
        $this->json = json_encode(array(
            'error'=>array(
                'message'=>$this->message)
            )
        );
    }

    function __toString()
    {
        return $this->message;
    }
}