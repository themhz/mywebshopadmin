<?php

namespace mywebshop\tools;

require '../vendor/autoload.php';
require '../config.php';

use mywebshop\models\XmlProducts;
use mywebshop\models\XmlProductsImages;
use mywebshop\models\XmlProductsAttributes;
use \DOMDocument;


$date = new \DateTime();

if (file_exists('C:\xampp\htdocs\mywebshop\tools\products.xml')) {
    //$xml = simplexml_load_file('C:\xampp\htdocs\mywebshop\tools\products.xml');
    $xml_product = new XmlProducts();
    $xml_product->delete();

    $xml_products_images = new XmlProductsImages();
    $xml_products_images->delete();

    $xml_products_attributes = new XmlProductsAttributes();
    $xml_products_attributes->delete();

    $objDOM = new DOMDocument();
    $objDOM->load("C:\\xampp\\htdocs\\mywebshop\\tools\\products.xml");

    $products = $objDOM->getElementsByTagName("product");

    $count = 0;
    foreach ($products as $product) {

        $xml_product = new XmlProducts();

        $xml_product->id = $product->getElementsByTagName('id')->item(0)->nodeValue;
        $xml_product->code = $product->getElementsByTagName('code')->item(0)->nodeValue;
        $xml_product->model = $product->getElementsByTagName('model')->item(0)->nodeValue;
        $xml_product->name = $product->getElementsByTagName('name')->item(0)->nodeValue;
        $xml_product->description = $product->getElementsByTagName('description')->item(0)->nodeValue."\n";
        $xml_product->category = $product->getElementsByTagName('category')->item(0)->nodeValue;
        $xml_product->manufacturer = $product->getElementsByTagName('manufacturer')->item(0)->nodeValue;
        $xml_product->season = $product->getElementsByTagName('season')->item(0)->nodeValue;
        $xml_product->link = $product->getElementsByTagName('link')->item(0)->nodeValue;
        $xml_product->wholesale_net_price = (float)$product->getElementsByTagName('wholesale_net_price')->item(0)->nodeValue;
        $xml_product->suggested_retail_price = (float)$product->getElementsByTagName('suggested_retail_price')->item(0)->nodeValue;
        $xml_product->availability = $product->getElementsByTagName('availability')->item(0)->nodeValue;
        $xml_product->video = $product->getElementsByTagName('video')->item(0)->nodeValue;
        $xml_product->insert();


        foreach($product->getElementsByTagName("image") as $image){
            //echo $image->nodeValue;
            $xml_products_images = new XmlProductsImages();
            $xml_products_images->product_id = $xml_product->id;
            $xml_products_images->image = $image->nodeValue;
            $xml_products_images->insert();

        }

        $count2 = 0;
        foreach($product->getElementsByTagName("attribute") as $attribute){

            $xml_products_attributes = new XmlProductsAttributes();
            $xml_products_attributes->product_id = $xml_product->id;
            $xml_products_attributes->value = $attribute->getElementsByTagName("value")->item(0)->nodeValue;;
            $xml_products_attributes->title = $attribute->getElementsByTagName("title")->item(0)->nodeValue;;
            $xml_products_attributes->insert();
        }

//        $count++;
//        if($count==2)
//            break;
    }

} else {
    exit('Failed to open test.xml.');
}