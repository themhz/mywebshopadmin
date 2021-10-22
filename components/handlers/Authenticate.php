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

class Authenticate extends User
{
    public $isAuthenticated = false;
    public $app;

    public function __construct($app)
    {
        parent::__construct();
        $this->app = $app;
    }


    public function authenticate(): void
    {
        if($this->isAuthenticated()) {

            $this->setUserDetailsFromSession();
        }
    }

    public function isAuthenticated(): bool
    {
        if($this->userDetailsIsSet()){
            $selectedResult = $this->getUserBySessionId();
            if(!empty($selectedResult[0]) && $selectedResult[0]->sessionid == $this->app->session->get("userdetails")->sessionid){
                $this->isAuthenticated = true;
                $this->setUserDetailsAndCreateCertificate($selectedResult[0]);

            }
        }

        return $this->isAuthenticated;
    }

    public function userDetailsIsSet(): bool{
        return !empty($this->app->session->get("userdetails"));
    }

    public function getUserBySessionId():array{
        return $this->select(["sessionid ="=> $this->app->session->get("userdetails")->sessionid]);
    }
    
    public function checkUserNameAndPassword(): bool
    {
        if ($this->hasUserNameAndPass()) {
            $result = $this->findUserEmail();
            $this->verifyUserNameAndPassword($result);

            return $this->isAuthenticated;
        }else{
            return false;
        }
    }

    public function findUserEmail() :array{
        return $this->select(['email =' => $this->app->request->body()['email']]);
    }

    public function hasUserNameAndPass(): bool
    {
        $request = $this->app->request->body();
        if (isset($request['email']) && isset($request['password']))
            return true;
        else
            return false;
    }

    public function verifyUserNameAndPassword($result): void
    {

        $passwordManager = new PasswordManager($this->app->request->body()['password']);

        if (isset($result[0]) && $passwordManager->verify($result[0]->password)) {
            $this->isAuthenticated = true;
            $this->setUserDetailsAndCreateCertificate($result[0]);
        } else {
            $this->isAuthenticated = false;            
        }
        
    }

    public function setUserDetailsAndCreateCertificate($result):void{

        $this->setUserDetails($result);
    }

    public function setUserDetails($details): void
    {

        $details->sessionid = $this->app->session->getId();
        $this->app->session->set('userdetails', $details);
        $this->app->session->set('loggedin', $this->isAuthenticated);

        $this->setUserDetailsFromSession();
    }

    public function setUserDetailsFromSession(){
        $this->isAuthenticated = true;
        $this->app->isloggedin = true;
        $this->app->user->loadData($this->app->session->get('userdetails'));

    }


   
}
