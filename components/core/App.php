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

namespace mywebshop\Components\core;

use mywebshop\components\handlers\Authenticate;
use mywebshop\components\handlers\Certificate;
use mywebshop\components\handlers\Request;
use mywebshop\components\handlers\Response;
use mywebshop\components\handlers\Session;
use mywebshop\components\core\Router;
use mywebshop\models\User;

/**
 * About
 * ----------------------------------------------------------------
 * Initialize the web application components
 * Everything begins here. 
 * 
 * 
 * Start reading from he start method
 */

class App
{
    public $config = CONFIG;
    public $rootpath;
    public $error;
    public $request;
    public $response;
    public $router;
    public $user;
    public $userPaths;
    public $session;
    public $isloggedin;
    public $certificate;

    public function __construct($rootpath)
    {
        $this->rootpath = $rootpath;
        $this->response = new Response();
        $this->session = new Session();
        $this->certificate = new Certificate();
        $this->user = new User();
        
    }

    /**
     *    Basic Control flow of tasks that will be executed when the application runs
     * ----------------------------------------------------------------------------------
     * 1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
     * 2. Authenticate the user request get userData and paths and set user session variables     
     * 3. Route the user to the corresponding controller     
     * 
     * @return void
     */
    public function start()
    {      
        // 1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
        $this->loadRequest();
        
        // 2. Authenticate the user request get userData and paths and set user session variables

        $this->authenticate();


        // 3. Route the user to the corresponding controller
        $this->route();

    }

    public function loadRequest(): void
    {
        $this->request = new Request();
    }

    public function authenticate(): void
    {      
        $auth = new Authenticate($this);
        $auth->authenticate();        
    }

    public function route(): void
    {

        $router = new Router($this);

        $router->resolve();
    }
}
