<?php

namespace mywebshop\components\handlers;
use mywebshop\components\handlers\PasswordValidator;
use mywebshop\components\handlers\RequiredValidator;
use mywebshop\components\handlers\UniqueValidator;
use mywebshop\components\handlers\EmailValidator;
use mywebshop\components\handlers\StringValidator;
use mywebshop\components\interfaces\Validator as iValidator;


class Validator
{
    public function __construct(){

    }

    public function selectValidation(string $type) : iValidator{

        switch ($type){
            case "password":
                return new PasswordValidator();
            case "unique":
                return new UniqueValidator();
            case "string":
                return new StringValidator();
            case "required":
                return new RequiredValidator();
            case "email":
                return new EmailValidator();
        }
    }

}