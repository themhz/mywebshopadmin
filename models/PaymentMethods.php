<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class PaymentMethods extends Model{

    public int $id;
    public string $name;
    public string $descr;
    public float $fee;
    public Date $regdate;
    public string $params;
    public string $username;
    public string $password;
    public string $url;

    public function __construct()
    {
        parent::__construct('payment_method');
    }

    public function create(string $name, string $descr, float $fee, string $params, string $username, string $password, string $url)
    {
        $this->name = $name;
        $this->descr = $descr;
        $this->fee = $fee;
        $this->regdate = $this->getRegdate();
        $this->params = $params;
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
    }


    
}