<?php

namespace mywebshop\components\handlers;

use mywebshop\components\interfaces\Validator;

class PasswordValidator implements Validator
{
    public $value;
    //checks if password contains letter, digit and a special characther
    public function validate(string $value): bool{
        $this->value = $value;
        $containsLetter  = preg_match('/[a-zA-Z]/',    $this->value);
        $containsDigit   = preg_match('/\d/',          $this->value);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $this->value);


        return $containsLetter && $containsDigit && $containsSpecial;

    }

}