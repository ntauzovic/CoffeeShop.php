<?php

namespace app\controllers;

use app\core\Controller;
use app\models\ListProductModel;

class HomeController extends Controller
{
    public function index(){
        $this->view("home", "empty", null);
    }


    public function rows(){


        $model= new ListProductModel();
        $model->mapData($this->router->request->all());

        $result= $model->searchData();
        echo $this->partialView("homeRows", $result);



    }

    public function authorize()
    {
        return[];
    }
}