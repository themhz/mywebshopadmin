<?php
namespace mywebshop\views\pages\register;
use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\components\handlers\Register;
use mywebshop\components\handlers\Response;

class Controller extends baseController{
    protected $app;
    public function __construct($app) {
        parent::__construct($app);
        $this->app = $app;
    }


    public function post(){
        $register = new Register($this->app);
        $result = $register->register();

        $response = new Response();
        $response->respond($result);

    }

    public function get(){

        $view = new view($this->app->request);
        echo $view->render('user', 'register', ["user"=> $this->app->user], "public");
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
}