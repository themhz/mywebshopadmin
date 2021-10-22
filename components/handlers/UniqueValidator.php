<?php

namespace mywebshop\components\handlers;

use mywebshop\components\interfaces\Validator;
use mywebshop\models\User;

class UniqueValidator implements Validator
{
    public $value;
    //checks if password contains letter, digit and a special characther
    public function validate(string $value):bool{
        $this->value = $value;
        $user = new User();
        $result = $user->select(["email =" => $this->value], []);

        if(count($result)>0)
            return false;
        else
            return true;

    }

}