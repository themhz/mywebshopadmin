<?php
namespace mywebshop\models;
use mywebshop\components\core\Model;
use mywebshop\models\Products;
use mywebshop\models\Vatcodes;

use \DateTime;

class Orders extends Model
{
    public int $id;
    public int $user_id;
    public string $email;
    public string $shipping_address;
    public string $shipping_postcode;
    public int $shipping_location_id;
    public int $payment_method_id;
    public int $shipping_method_id;
    public float $amount;
    public float $amount_with_tax;

    public function __construct($user_id=-1)
    {
        $this->user_id = $user_id;
        parent::__construct('orders');
    }

    public function create($basket) : array{

        //$this->user_id = -1; //unknown or not logged in-1
        $this->email = $basket["email"]->email;
        $this->shipping_address = $basket["address"]->address;
        $this->shipping_postcode= $basket["zipcode"]->zipcode;
        $this->shipping_location_id = $basket["location"]->location;
        $this->payment_method_id = $basket["paymentMethod"]->paymentMethod;
        $this->shipping_method_id = $basket["shippingMethod"]->shippingMethod;
        $this->calculateTotalCost($basket);  //$this->amount;
        $this->calculateTotalCostWithTask($basket);  //$this->amount_with_tax;

        $errors = [];
        $errors = $this->validate();

        if(count($errors)>0){

            return [$errors, "error"];
        }else{

            $this->id =$this->insert();
            return [$this->id, "success"];
        }


    }

    public function calculateTotalCost($basket): float{
        $price = 0;
        foreach($basket["products"] as $product){
            $price += $product->price * $product->qty;
        }
        $this->amount =$price;
        return $this->amount;
    }

    public function calculateTotalCostWithTask($basket): float{
        $this->amount_with_tax= ($this->getVatCodeRate($basket["vatid"]->vatid) * $this->amount /100) + $this->amount;
        return $this->amount_with_tax;
    }

    public function getVatCodeRate($id) : float{
        $vatcodes = new Vatcodes();
        $rate = $vatcodes->select(["id ="=>$id])[0];
        return $rate->rate;
    }


    public function validate() : array{

        $errors = [];
        foreach($this->rules() as $rule){
            if((empty($this->{$rule[0]}) && $rule[2] =="required") ){
                array_push($errors, $rule);
            }
        }


        return $errors;
    }


    public function rules() :array{
        return [
            ["user_id", "integer", "required"],
            ["email", "string", "required"],
            ["shipping_address", "string", "required"],
            ["shipping_postcode", "string", "required"],
            ["shipping_location_id", "integer", "required"],
            ["payment_method_id", "integer", "required"],
            ["shipping_method_id", "integer", "required"],
            ["amount", "double", "required"],
            ["amount_with_tax", "double", "required"],
        ];
    }


}

