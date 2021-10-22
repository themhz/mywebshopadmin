<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;
use mywebshop\models\Products;


class CheckOut extends Model{

    public Products $products;
    public PaymentMethods $paymentMethods;
    public ShippingMethods $shippingMethods;
    public Orders $orders;
    public User $user;

    
}