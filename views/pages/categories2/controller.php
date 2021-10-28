<?php

namespace mywebshop\views\pages\categories2;

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
        $categories = new Categories();
        foreach($nodes as $node){
            //echo $node->id . ' ' . $node->name;
            //print_r(count((array)$node->elements));
            //die();
            if(count((array)$node->elements)){
                foreach($node->elements as $subnode) {
                    //echo ' has ' . $subnode->id . "\n";
                    $categories->id = $subnode->id;
                    $categories->parent_id = $node->id;
                    $categories->update();

                }

            }else{
                echo " has no sub nodes \n";
            }

        }

        echo "finished update";
    }

    public function get()
    {
        $categories =  new Categories();

        $categories = $categories->select();
        $view = new view($this->app->request);
        echo $view->render('main', "categories2", ["categories"=>$categories],'public');

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
