<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;


class Shop extends Model{

    public int $id;
    public DateTime $opened;
    public DateTime $closed;
    public string $metatitle;
    public string $metadescription;
    public string $metakeywords;
    public string $facebookpage;
    public string $twitterpage;
    public string $youtubepage;

    public function __construct()
    {
        parent::__construct('shop');
    }

}