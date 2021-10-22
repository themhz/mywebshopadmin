<?php

namespace mywebshop\views\pages\login;

use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\components\handlers\Session;
use mywebshop\components\handlers\Authenticate;

class Controller extends baseController
{
    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {
        $authenticate = new Authenticate($this->app);
        $result = $authenticate->checkUserNameAndPassword();

        if($result==true){
            $authenticate->setUserDetailsAndCreateCertificate($this->app->session->getAll()["userdetails"]);
            $this->app->user->update(false, ["firstname", "lastname","phone","email","address","city","zipcode","password","regdate"]);
            $view = new view();
            echo $view->render('main', 'main', ["user"=>$this->app->user], 'public');
        }else{
            $view = new view();
            echo $view->render('user', 'error', ["user"=>$this->app->user, "error"=>"wrong username or password"], 'public');

        }
    }

    public function get()
    {

         $view = new view();
         echo $view->render('user', 'login', [ "user"=>$this->app->user], 'public');
    }

    public function put()
    {
        echo "put";
    }

    public function delete()
    {
        echo "delete";
    }

}
