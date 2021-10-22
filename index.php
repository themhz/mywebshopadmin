<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

use mywebshop\components\core\App;

require 'vendor/autoload.php';
require 'config.php';

$app = new App(dirname(__DIR__));
$app->start();


