<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class XmlProducts extends Model
{
    public int $id;
    public string $code;
    public string $model;
    public string $name;
    public string $description;
    public string $category;
    public string $manufacturer;
    public string $season;
    public string $link;
    public float $wholesale_net_price;
    public float $suggested_retail_price;
    public string $availability;
    public string $video;

    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('xml_products');
    }

}
