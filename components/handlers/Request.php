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


/**
 * @author Eythimios Theotokatos <themhz@email.com>
 * @about http This is an http class that is used to get the http method request, the body in a safe way
 */

namespace mywebshop\components\handlers;

class Request
{

    public string $method;
    /**
     * initialize the http method
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Returns the HTTP requested method
     *
     * @return string of the requested HTTP method in lower case
     */
    public function method(): string
    {
        return strtolower($this->method);
    }

    /**
     * Gets the body of the http request from post or put or get etc.. and filters the input sanitizing the request
     *
     * @return array
     */
    public function body(): array
    {
        $body = [];
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post') {
            $contenttype = explode(';', $_SERVER["CONTENT_TYPE"]);

            if(in_array("application/json", $contenttype)){
                $json = file_get_contents('php://input');
                $body = (Array)json_decode($json);



            }else{
                foreach ($_POST as $key => $value) {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }

        if ($this->method() === 'put') {
            $putdata = file_get_contents('php://input');
            $putdata = explode("&", $putdata);
            foreach ($putdata as $putitem) {
                $data = explode("=", $putitem);
                $body[$data[0]] = urldecode(filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }

        if ($this->method() === 'delete') {

            $putdata = file_get_contents('php://input');
            $putdata = explode("&", $putdata);
            foreach ($putdata as $putitem) {
                $data = explode("=", $putitem);
                $body[$data[0]] = urldecode(filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }

        return $body;
    }

    public function path()
    {

        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);           
        }

        if ($path == "/" || $path == "") {         
            $path = 'main';
        }
        return $path;
    }

    function url()
    {
        return sprintf(
            "%s://%s:%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['SERVER_PORT']
        );
    }


    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function isPut()
    {
        return $this->method() === 'put';
    }

    public function isDelete()
    {
        return $this->method() === 'delete';
    }
}
