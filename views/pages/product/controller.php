<?php
namespace mywebshop\views\pages\product;
use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\models\Products;
use mywebshop\models\ProductImages;
use mywebshop\components\handlers\Response;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){

        $params = $this->app->request->body();
        $product = new Products();
        $product->loadData($params);
        $result = $product->update();
        $resp =  new Response();
        if($result['result']){
            $resp->setStatusCode(200);
            $resp->respond(["message" => "update was successfull", "result" => true]);
        }else{
            $resp->setStatusCode(200);
            $resp->respond(["message" => "update did not succeed", "result" => false, "error"=>$resp]);
        }

    }

    public function get(){

        $requestparams = $this->app->request->body();        
        $product = new Products();
        $ProductImages = new ProductImages();
        $product = $product->select(['id ='=>$requestparams['product_id']])[0];
        $product->images =  $ProductImages->select(['product_id ='=>$requestparams['product_id']]);

        $product->user = $this->app->user;
        $view = new view($this->app->request);
        echo $view->render('main', $this->app->request->path(), $product, 'public');
    }

    public function put(){
        
    }

    public function delete(){
        
    }
}