<?php

/* 
 * Copyright (C) 2021 themhz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace mywebshop\components\handlers;

use mywebshop\components\handlers\PasswordManager;
use mywebshop\models\User;
use mywebshop\components\Handlers\Request;

class Register extends User
{

    private $result;
    private $app;

    public function __construct($app)
    {
        parent::__construct();
        $this->app = $app;
    }
    /**
     * Register the user
     *
     * @return array
     */
    public function register(): array
    {
        $userrbody = $this->app->request->body();
        $passwordManager =  new PasswordManager($userrbody["password"]);
        $this->loadData($userrbody);
        $result = $this->validate();

        $this->password = $passwordManager->hash();

        if(count($result) == 0){
            $result = $this->insert();
            return ["id"=>$result, "result"=>1];
        }else{
            return ["id"=>-1, "result"=>0, "errors"=>$result];
        }

    }

    /**
     * Get the value of result
     */ 
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the value of result
     *
     * @return  self
     */ 
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }
}
