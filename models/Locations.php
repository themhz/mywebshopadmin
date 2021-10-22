<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class Locations extends Model
{

    public int $id;
    public string $dimos;
    public string $nomos;
    public string $vatid;

    public function __construct()
    {
        parent::__construct('locations');
    }

}