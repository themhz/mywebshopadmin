<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class XmlProductsImages extends Model
{
    public int $id;
    public string $product_id;
    public string $image;

    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('xml_products_images');
    }

}
