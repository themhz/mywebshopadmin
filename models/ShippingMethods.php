<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class ShippingMethods extends Model{

    public int $id;
    public string $name;
    public string $descr;
    public int $shipping_company;
    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('shipping_method');
    }


}