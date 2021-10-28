<?php

namespace mywebshop\views\pages\test;

use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use SampleWebApp\models\Products;
use mywebshop\models\Categories;

class Controller extends baseController
{

    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {
        $nodes = $this->app->request->body();
        foreach($nodes as $node){
            echo $node->name;
            //print_r(count((array)$node->elements));
            //die();
            if(count((array)$node->elements)){
                foreach($node->elements as $subnode) {
                    echo ' has ' . $subnode . "\n";
                }
            }else{
                echo " has no sub nodes \n";
            }



        }

    }

    public function get()
    {
        $categories =  new Categories();

        $categories = $categories->select();
        $view = new view($this->app->request);
        echo $view->render('main', "test", ["categories"=>$categories],'public');

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
