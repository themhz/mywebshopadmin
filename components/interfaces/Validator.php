<?php

namespace mywebshop\components\interfaces;

interface Validator{

    public function validate(string $value) :bool;

}