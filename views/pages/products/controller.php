<?php
namespace mywebshop\views\pages\products;
use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\models\Products;


class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
        echo "this is the products";
        $p = new Products();

        print_r($p->select());
        // $params = $this->app->request->body();
        // $view = new view($this->app);
        // echo $view->render('main', $this->app->request->path() , $params);
    }

    public function get(){
        
       
        $requestparams = $this->app->request->body();

        $params = [];
        $p = new Products();
        $products = $p->getProductsByCategory($requestparams);
              
        $products["user"] = $this->app->user;
        
        $view = new view($this->app->request);
            echo $view->render('main', 'products', $products,'public');
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }

    public function getProducts(){
        $requestparams = $this->app->request->body();

        $params = [];
        $p = new Products();
        $products = $p->getProductsByCategory($requestparams);
        echo json_encode($products[0]);
    }
}