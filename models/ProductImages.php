<?php
namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class ProductImages extends Model
{
    public int $id;
    public int $product_id;
    public string $image;
    public int $order;
    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('product_images');
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
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    /**
     * @return DateTime
     */
    public function getRegdate(): DateTime
    {
        return $this->regdate;
    }

    /**
     * @param DateTime $regdate
     */
    public function setRegdate(DateTime $regdate): void
    {
        $this->regdate = $regdate;
    }



}