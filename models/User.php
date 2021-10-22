<?php

namespace mywebshop\models;
use mywebshop\components\core\Model;
use \DateTime;

class User extends Model
{
    public int $id = -1;
    public string $firstname ="";
    public string $lastname ="";
    public string $phone = "";
    public string $email ="";
    public string $address ="";
    public string $city ="";
    public string $zipcode ="";
    public string $password ="";
    public string $sessionid ="";
    public string $regdate;

    public function __construct()
    {
        parent::__construct('users', $this->getRules());

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
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function getRules() : array{
        return [
            ["firstname", ["string", "required"]],
            ["lastname", ["string", "required"]],
            ["email", ["email", "required", "unique"]],
            ["phone", ["string", "required"]],
            ["password", ["password", "required"]]
        ];
    }
}
