<?php
namespace mywebshop\views\pages\product;
use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\models\Products;
use mywebshop\models\ProductImages;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
        echo "this is the products";     
    }

//    public function get(){
//
//        $requestparams = $this->app->request->body();
//
//         $params = [];
//         $p = new Products();
//         $sql = "SELECT * from products ";
//        if(isset($requestparams['product_id'])){
//            $sql .= ' where id = :product_id';
//            $params = [':product_id' => $requestparams['product_id']];
//        }
//
//         $products = $p->customselect($sql, $params);
//
//
//         $view = new view($this->app->request);
//         echo $view->render('inner', $this->app->request->path() , $products);
//    }

    public function get(){

        $requestparams = $this->app->request->body();
        $product = new Products();
        $ProductImages = new ProductImages();
        $product = $product->select(['id ='=>$requestparams['product_id']])[0];
        $product->images =  $ProductImages->select(['product_id ='=>$requestparams['product_id']]);

        $product->user = $this->app->user;
        $view = new view($this->app->request);
        echo $view->render('inner', $this->app->request->path(), $product, 'public');
    }

    public function put(){
        
    }

    public function delete(){
        
    }
}