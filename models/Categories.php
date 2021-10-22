<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class Categories extends Model
{
    public int $id;
    public int $parent_id;
    public string $name;
    public DateTime $regdate;

    public function __construct()
    {        
        parent::__construct('categories');
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of parent_id
     */ 
    public function getParent_id()
    {
        return $this->parent_id;
    }

    /**
     * Set the value of parent_id
     *
     * @return  self
     */ 
    public function setParent_id($parent_id)
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of regdate
     */ 
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * Set the value of regdate
     *
     * @return  self
     */ 
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;

        return $this;
    }
}