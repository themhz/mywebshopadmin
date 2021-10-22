<?php

namespace mywebshop\views\pages\main;

use mywebshop\components\core\Controller as baseController;
use mywebshop\components\core\View;
use mywebshop\components\handlers\FileUploader;
use mywebshop\models\Categories;

use SampleWebApp\models\Products;

class Controller extends baseController
{

    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {
        $target_dir = $this->app->rootpath . DIRECTORY_SEPARATOR . 'SampleWebApp' . DIRECTORY_SEPARATOR . 'userfiles' . DIRECTORY_SEPARATOR;
        $fileUploader = new FileUploader($target_dir);
        $fileUploader->upload();
    }

    public function get()
    {

        $view = new view($this->app->request);
        echo $view->render('main', 'main', ["user"=>$this->app->user], 'public');
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
        //$data = $categories->select([],['parent_id'=>'asc', 'id'=>'asc']);        
        $data = $categories->customselect("WITH RECURSIVE menu (id, parent_id, name, path, lvl) AS
                                            (
                                            SELECT id, parent_id, name, name as path, 0 lvl
                                                FROM categories
                                                WHERE parent_id =0 and published = 1
                                            UNION ALL
                                            SELECT c.id, c.parent_id, c.name, CONCAT(cp.path, ' > ', c.name) ,cp.lvl + 1
                                                FROM menu AS cp 
                                                JOIN categories AS c ON cp.id = c.parent_id
                                                where c.published = 1
                                            )    
                                            SELECT a.*, count(b.product_id) num_of_products FROM menu a
                                                left join product_categories b on b.category_id = a.id        
                                                 group by a.id
                                            order by a.lvl ,a.id asc    
                                            ;");
        $menu = [];

        foreach ($data as $row) {            
            $menu[] = ['id' => $row->id, 'parent_id' => $row->parent_id, 'name' => $row->name, 'children' => [], 'lvl' => $row->lvl, 'num_of_products' => $row->num_of_products];
        }

        echo json_encode($menu);
    }
}
