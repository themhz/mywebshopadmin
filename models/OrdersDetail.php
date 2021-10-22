<?php

namespace mywebshop\models;

use mywebshop\components\core\Model;

use \DateTime;

class OrdersDetail extends Model
{
    public int $id;
    public int $order_id;
    public int $product_id;
    public float $amount;
    public float $amount_with_tax;

    public function __construct()
    {
        parent::__construct('Orders_detail');
    }

    public function create(int $order_id, int $product_id, float $amount,  float $amount_with_tax)
    {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->amount = $amount;
        $this->amount_with_tax = $amount_with_tax;
    }
}
