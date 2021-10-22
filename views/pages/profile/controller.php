<?php
namespace mywebshop\views\pages\profile;
use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\models\User;
use mywebshop\models\Orders;
use mywebshop\models\OrderItems;

class Controller extends baseController{
    public function __construct($app) {
        parent::__construct($app);
    }


    public function post(){
        $params = (object)$this->app->request->body();
        switch($params->method){
            case "updateAccount":
                $this->updateAccount();
                break;
            case "updatePassword":
                $this->updatePassword();
                break;
        }
    }

    public function updateAccount(){
        $params = (object)$this->app->request->body();

        $user = new User();
        $this->app->user->email = $params->email;
        $this->app->user->firstname = $params->firstname;
        $this->app->user->lastname = $params->lastname;
        $this->app->user->phone = $params->phone;
        $this->app->user->address = $params->address;
        $this->app->user->city = $params->city;
        $this->app->user->zipcode = $params->zipcode;


        $user->id = $this->app->user->id;
        $user->email = $params->email;
        $user->firstname = $params->firstname;
        $user->lastname = $params->lastname;
        $user->phone = $params->phone;
        $user->address = $params->address;
        $user->city = $params->city;
        $user->zipcode = $params->zipcode;
        $user->password = $this->app->user->password;

        $result = $user->update();

        $this->respond($result["result"]);
    }

    public function updatePassword(){

    }

    public function get(){

        $orders = new Orders($this->app->user->id);
        $orders = $orders->select(["user_id ="=> $this->app->user->id]);

        $orderItemsHolder = [];

        foreach ($orders as $order){
            $orderItems = new OrderItems($order->id);
            $orderItemsHolder[$order->id] = $orderItems->select(["order_id ="=>$order->id]);

        }

     
        $view = new view($this->app->request);
        echo $view->render('user', 'profile', ['user'=>$this->app->user, 'orders'=>$orders, 'orderitems'=>$orderItemsHolder], 'public');
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }


}