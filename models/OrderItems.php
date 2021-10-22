<?php
namespace mywebshop\models;
use mywebshop\components\core\Model;
use mywebshop\models\products;
use mywebshop\models\vatcodes;

class OrderItems extends Model
{
    public int $order_id;
    public int $product_id;
    public float $amount;
    public float $amount_with_tax;
    public int $qty;
    public Date $regdate;

    /**
     * @param $id
     * @param $order_id
     */
    public function __construct($order_id=-1)
    {
        parent::__construct('order_items');
        $this->order_id = $order_id;
    }

    public function create($basket){

        try{
            $count =0;
            foreach($basket["products"] as $basketitem){
                $product = $this->findProduct($basketitem->id)[0];
                $this->product_id = $product->id;
                $this->qty = $basketitem->qty;
                $this->amount = $product->price *  $this->qty;
                $this->amount_with_tax = $this->calculateTotalCostWithVat($basket);
                $this->insert();
                $count++;
            }

            return ["result"=>"success", "message"=>"successfully added $count products in orders for order $this->order_id"];
        }catch (\Exception $ex){
            return ["result"=>"error", "message"=>$ex->getMessage()];
        }
    }

    public function findProduct($id){
        $product = new Products();
        $product = $product->select(["id ="=>$id]);
        return $product;

    }

    public function getVatCodeRate($vatid){

        $vatrate = new Vatcodes();
        return $vatrate->select(["id ="=>$vatid])[0]->rate;
    }

    public function calculateTotalCostWithVat($basket): float{
        $this->amount_with_tax= ($this->getVatCodeRate($basket["vatid"]->vatid) * $this->amount /100) + $this->amount;
        return $this->amount_with_tax;

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getAmountWithTax(): float
    {
        return $this->amount_with_tax;
    }

    /**
     * @param float $amount_with_tax
     */
    public function setAmountWithTax(float $amount_with_tax): void
    {
        $this->amount_with_tax = $amount_with_tax;
    }

    /**
     * @return Date
     */
    public function getRegdate(): string
    {
        if(empty($this->regdate)){
            $date = new \DateTime();
            return $date->format('Y/m/d H:i:s');
        }

        return $this->regdate;

    }

    /**
     * @param Date $regdate
     */
    public function setRegdate(Date $regdate): void
    {
        $this->regdate = $regdate;
    }


}