<?php

namespace mywebshop\views\pages\order_items;

use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\components\handlers\FileUploader;
use mywebshop\models\Categories;
use mywebshop\components\handlers\Request;
use mywebshop\components\handlers\Order;
use mywebshop\models\OrderItems;
use mywebshop\models\PaymentMethods;
use mywebshop\models\ShippingMethods;
use SampleWebApp\models\Products;


class Controller extends baseController
{
    private $view;

    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {

    }

    public function get()
    {
        $order = $this->app->request->body();

        $order_items = new OrderItems();
        $order_items = $order_items->select(["order_id="=>$order["order_id"]]);
        $this->respond($order_items);
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
