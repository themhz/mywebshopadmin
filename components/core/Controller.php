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
namespace mywebshop\components\core;

/**
 * This class must and is used by every controller in the system
 * Simply add an app attribute in order to access app stuff within the business logic
 * 
 */

abstract class Controller
{
    protected $app;
    public $method;
    
    public function __construct($app){
        $this->app = $app;
        $method = $app->request;
        if(isset($method->body()['method'])){ 
            $this->method = $method->body()['method'];
        }        
    }

    public function respond($data){
        echo json_encode($data);
    }


}
