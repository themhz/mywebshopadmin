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


class Router
{

    public $path;
    public $method;
    public $app;
    protected array $routes = [];

    public function __construct($app)
    {
        $this->app = $app;
        $this->path = $this->app->request->path();
        $this->method = $this->app->request->method();
    }

    public function resolve()
    {

        try{
            $controller = '\mywebshop\views\pages\\' . $this->getController() . '\Controller';
            $this->loadController($controller);

        }catch(\Exception $ex){
                $this->app->response->setStatusCode(403);
                $this->app->error = "You can't access this page";
                $this->loadErrorController();
        }



//            if (!$this->checkIfPageIsAdmin()) {
//
//                $controller = '\mywebshop\views\pages\\' . $this->getController() . '\Controller';
//                $this->loadController($controller);
//
//            } else if ($this->app->session->get('loggedin') && $this->userCanAccess()) {
//                $controller = '\mywebshop\views\pages\\' . $this->getAdminPath() . '\Controller';
//
//                $this->loadController($controller);
//
//            } else {
//
//                $this->app->response->setStatusCode(403);
//                $this->app->error = "You can't access this page";
//                $this->loadErrorController();
//            }
    }

    public function userCanAccess()
    {       
        
        return $this->app->userPaths->validate($this->getAdminPath());
    }

    public function loadController($controller): void
    {        
      
        // echo $controller; //mywebshop\views\main\Controller
        // die();
        $controller = new $controller($this->app);
        
        if(!empty($controller->method && method_exists($controller, $controller->method))){

            $method = $controller->method;
            $controller->$method();
        }else{

            $method = $this->method;
            $controller->$method();
        }        
    }

    public function loadErrorController(): void
    {
        $controller = '\mywebshop\views\error\Controller';
        $controller = new $controller($this->app);
        $controller->get();
    }

    public function checkIfPageIsAdmin()
    {        
        $paths = explode('/', $this->path);

        if($paths[0]=="main"){
            return false;
        }

    }

    public function getAdminPath()
    {
        $paths = explode('/', $this->path);        
        if (isset($paths[2]) &&  $paths[2] != ""){
            return $paths[2];
        }else{
            return  'main';
        }                                
    }

    public function getController()
    {

        if ($this->path == "") {
            $controller = 'main';
        } else {
            $controller = explode("/", $this->path);
            if (!empty($controller[0])) {
                $controller = $controller[0];
            } else {
                $controller = $controller[1];
            }
        }

        return $controller;
    }

    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of method
     */ 
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */ 
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of app
     */ 
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Set the value of app
     *
     * @return  self
     */ 
    public function setApp($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get the value of routes
     */ 
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Set the value of routes
     *
     * @return  self
     */ 
    public function setRoutes($routes)
    {
        $this->routes = $routes;

        return $this;
    }
}
