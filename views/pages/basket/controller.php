<?php

namespace mywebshop\views\pages\basket;

use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\components\handlers\FileUploader;
use mywebshop\components\handlers\Session;
use mywebshop\models\Categories;
use mywebshop\components\handlers\WebServiceCaller;
use mywebshop\components\handlers\Order;
use mywebshop\models\OrderItems;
use mywebshop\models\PaymentMethods;
use mywebshop\models\ShippingMethods;
use mywebshop\models\Locations;
use mywebshop\models\Vatcodes;
use mywebshop\models\ShippingMethodRatings;
use mywebshop\models\Orders;


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
        //Calculate total budget
        $basket = $this->app->request->body();

        //Create the order
         $order = new Orders($this->app->user->id);
         $result = $order->create($basket);


         if($result[1]=="success"){
             $order_items = new OrderItems($result[0]);
             $this->respond($order_items->create($basket));
         }else{
             $this->respond($result);
         }

    }

    public function get()
    {

        $paymentMethods = new PaymentMethods();
        $shippingMethods = new ShippingMethods();
        $shippingMethodsRatings = new ShippingMethodRatings();

        $locations = new Locations();
        $locations =  $locations->select([],["nomos"=>"asc", "dimos"=> "asc"]);

        $vatcodes =  new vatcodes();
        $vatcodes =  $vatcodes->select();


        echo $this->view->render('user', 'basket', ["paymentMethods"=>$paymentMethods->select(), "shippingMethods" => $shippingMethods->select(), "locations" =>$locations, "vatcodes"=>$vatcodes, "shippingMethodsRatings" => $shippingMethodsRatings->select(), "user"=>$this->app->user], 'public');
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


        $categories = new Categories();
        $data = $categories->select();        
        $menu = [];

        foreach ($data as $row) {            
            $menu[] = ['id' => $row->id, 'parent_id' => $row->parent_id, 'name' => $row->name, 'children' => []];            
        }

        echo json_encode($menu);
    }
}
