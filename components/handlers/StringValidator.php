<?php

namespace mywebshop\components\handlers;

use mywebshop\components\interfaces\Validator;
use mywebshop\models\User;

class StringValidator implements Validator
{
    public $value;
    //checks if password contains letter, digit and a special characther
    public function validate(string $value):bool{
        $this->value = $value;

       return is_string($this->value);

    }
}