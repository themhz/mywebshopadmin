<?php

namespace mywebshop\models;

use mywebshop\components\core\Model;

class ShippingMethodRatings extends Model
{
    public int $id;
    public string $shipping_method_id;
    public string $weight_kg;
    public int $cost;

    public function __construct()
    {
        parent::__construct('shipping_method_ratings');
    }
}