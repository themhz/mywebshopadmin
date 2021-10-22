<?php

namespace mywebshop\components\handlers;
use mywebshop\components\handlers\WebApi;

class WebServiceCaller extends WebApi
{
    /**
     * Constructor to call the parent constructor
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Sends the sms using the routee.net web services sms method
     *
     * @return string
     */
    public function send($message)
    {

        $options[CURLOPT_URL] = CONFIG['paymentUrl'];
        //$options[CURLOPT_CAINFO] = $this->curlCainfo;
        $options[CURLOPT_POSTFIELDS] = "{ \"data\": \"$message\"}";
        $options[CURLOPT_HTTPHEADER] = array(
            "content-type: application/json"
        );

        $this->options += $options;

        return $this->processUrl();
    }
}