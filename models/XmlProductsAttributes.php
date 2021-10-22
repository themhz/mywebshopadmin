<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class XmlProductsAttributes extends Model
{
    public int $id;
    public int $product_id;
    public string $value;
    public string $title;

    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('xml_products_attributes');
    }

}
