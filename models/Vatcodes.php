<?php

namespace mywebshop\models;

use mywebshop\components\core\Model;

class Vatcodes extends Model
{
    public int $id;
    public string $name;
    public string $rate;

    public function __construct()
    {
        parent::__construct('vatcodes');
    }



}