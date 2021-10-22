<?php

namespace mywebshop\components\handlers;
use mywebshop\components\handlers\Session;
use mywebshop\models\Products;
use mywebshop\models\Order_items;
use mywebshop\models\Vatcodes;
use mywebshop\models\Locations;

class Order
{
    private $id;
    private array $order_items;
    private float $total = 0;
    private float $vatrate = 0;

    //Creates the order id using the sessionid + datetimestamp to the milisecond
    public function __construct(Session $session)
    {
        $date = new \DateTime();
        $timestamp = $date->format('Y_m_d_H_i_s_ms_u');
        $timestamp = str_replace("_","",$timestamp);
        $this->id = $session->getId().$timestamp;
    }

    public function addProducts($items){

        $products = new Products();
        foreach($items["products"] as $item){
            $orderItems = new Order_items();
            //$orderItems->setOrderId($product->id);
            //$orderItems->setOrderId($orderid);
            $product = $products->select(["id ="=>$item->id], [])[0];
            $this->calculateProductPriceWithQty($product, $item->qty);
            echo $this->id."\n";
            echo $product->id."\n";
            echo $product->price."\n";

        }
            echo "total price :". $this->total."\n";
            echo "paymentMethod :" .$items["shippingMethod"]->shippingMethod."\n";
            echo "paymentMethod :".$items["paymentMethod"]->paymentMethod."\n";
            echo "location :".$items["location"]->location."\n";
            echo "zipcode :".$items["zipcode"]->zipcode."\n";
            echo "address :".$items["address"]->address."\n";
            echo "email :".$items["email"]->email."\n";
            $this->vatrate = $this->getVatCodeRate($items["vatid"]->vatid);
            //echo "get vat rating :".$this->getVatCodeRate($items["vatid"]->vatid);
        //die();
        //$order_items

    }

    //Get the product item, and the quantity and multiply
    public function calculateProductPriceWithQty($product, $qty){
        $this->total += $product->price * $qty;
    }

    public function calculateTotalWithVatRate(): float{
        $this->total = ($this->total * $this->vatrate/100) + $this->total;
        return $this->total;
    }

    public function getVatCodeRate($id) : float{
        $vatcodes = new Vatcodes();
        $rate = $vatcodes->select(["id ="=>$id])[0];
        return $rate->rate;
    }

    public function getLocationVatCode(){

    }



    public function getId(): string
    {
        return $this->id;
    }

}