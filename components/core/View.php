<?php

/* 
 * Copyright (C) 2021 themhz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace mywebshop\components\core;

use mywebshop\components\handlers\Session;

class View
{


    public function __construct()
    {
    }

    public function render($layout = 'main', $view = "", $params = [], $acceess = 'public')
    {

        $layoutContent = $this->layout($layout, $params,"", $acceess);

        $headerContent = $this->header($params, $acceess);
        $viewContent = $this->view($view, $params, $acceess);

        $layoutContent = str_replace('{{HEADER}}', $headerContent, $layoutContent);
        return str_replace('{{VIEW}}', $viewContent, $layoutContent);
    }

    protected function layout($layout = 'main', $params=[], $menu = "", $acceess =  'public')
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        //make the session variables available for the layout via the session object
         $session = new Session();
       
         if(isset($session->getAll()['userdetails'] )){
            foreach($session->getAll()['userdetails'] as $key => $value) {
                $$key = $value;
            }
         }
         

        ob_start();
      
        include_once "views/layouts/$layout.php";
        
        return ob_get_clean();
    }

    protected function view($view, $params, $acceess = 'public')
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once "views/pages/$view/view.php";
        return ob_get_clean();
    }

    protected function header($params, $acceess)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        
       
        include_once "views/layouts/header.php";
          
        return ob_get_clean();
    }
}
