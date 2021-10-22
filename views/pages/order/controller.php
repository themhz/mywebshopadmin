<?php

namespace mywebshop\views\pages\order;

use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\components\handlers\FileUploader;
use mywebshop\models\Categories;
use mywebshop\components\handlers\Request;
use mywebshop\components\handlers\Order;
use mywebshop\models\Order_items;
use mywebshop\models\PaymentMethods;
use mywebshop\models\ShippingMethods;
use SampleWebApp\models\Products;


class Controller extends baseController
{
    private $view;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->view = new view($this->app->request);
    }

    public function post()
    {
        $products = $this->app->request->body();
        echo "we create the order here";
        //print_r($products);
        //$order = new Order($this->app->session);
        //$order->addProducts($products);
        //echo $order->getId();

        //$order_items = new Order_items(1, 2);
        //echo $order_items->getRegdate();

    }

    public function get()
    {
        $user = $this->app->user;
        echo $this->view->render('user', 'order', ['user'=>$user], 'public');
    }

    public function put()
    {
        echo "put";
    }

    public function delete()
    {
        echo "delete";
    }

    public function getmenu()
    {

        // $menu = "<script>const data = JSON.parse('".$menu ."');         
        // let tree = buildList(data);
        // buildUlLi(tree);
        // document.getElementById('menu').innerHTML = list+'<ul>';
        // </script>";

        $categories = new Categories();
        $data = $categories->select();        
        $menu = [];

        foreach ($data as $row) {            
            $menu[] = ['id' => $row->id, 'parent_id' => $row->parent_id, 'name' => $row->name, 'children' => []];            
        }

        echo json_encode($menu);
    }
}
