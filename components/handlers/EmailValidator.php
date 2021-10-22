<?php

namespace mywebshop\components\handlers;

use mywebshop\components\interfaces\Validator;
use mywebshop\models\User;

class EmailValidator implements Validator
{
    public $value;
    //checks if password contains letter, digit and a special characther
    public function validate(string $value):bool{
        $this->value = $value;
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);

    }
}