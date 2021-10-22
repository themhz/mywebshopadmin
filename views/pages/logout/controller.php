<?php

namespace mywebshop\views\pages\logout;

use mywebshop\components\core\Controller as baseController;
use mywebshop\components\handlers\Session;

class Controller extends baseController
{
    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {

    }

    public function get()
    {
        $user = $this->app->user;
        $user->sessionid = "";
        $user->update(false, ["password"]);
        $this->app->session->clear();
        header('Location: ' . 'main');
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
