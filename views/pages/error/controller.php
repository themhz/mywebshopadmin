<?php
namespace mywebshop\views\pages\error;
use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
        $params = ['error'=> $this->app->error] + $this->app->request->body();
        $view = new view($this->app);
        echo $view->render('error', 'error' , $params);
    }

    public function get(){
        $params = ['error'=>  $this->app->error] + $this->app->request->body();
        $params['user'] = $this->app->user;
        $view = new view($this->app);
        echo $view->render('error', 'error' , $params, 'public');
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
    
}