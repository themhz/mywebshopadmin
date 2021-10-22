<?php
namespace mywebshop\models;

class UserLogin extends User{
 
    public $errorcode;
    public $isloggedin;
    public $error;


    public function __construct(){}
         

    /**
     * Get the value of errorcode
     */ 
    public function getErrorcode()
    {
        return isset($this->errorcode)? $this->errorcode : "";
    }

    /**
     * Set the value of errorcode
     *
     * @return  self
     */ 
    public function setErrorcode($errorcode)
    {
        $this->errorcode = $errorcode;

        return $this;
    }

    /**
     * Get the value of isloggedin
     */ 
    public function getIsloggedin()
    {
        return isset($this->isloggedin)? $this->isloggedin : "";
    }

    /**
     * Set the value of isloggedin
     *
     * @return  self
     */ 
    public function setIsloggedin($isloggedin)
    {
        $this->isloggedin = $isloggedin;

        return $this;
    }

    /**
     * Get the value of error
     */ 
    public function getError()
    {
        return isset($this->error)? $this->error : "";
    }

    /**
     * Set the value of error
     *
     * @return  self
     */ 
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }
}