<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\ListProductModel;
use app\models\ProductModel;

class ProductController extends Controller

{

    public function index()
    {
        return $this->view("products", "dashboardd", null);

    }

    public function rows()
    {


        $model = new ListProductModel();
        $model->mapData($this->router->request->all());

        echo $model->search();

    }

    public function create()
    {
        $model = new ProductModel();

        $this->view("createProduct", "dashboardd", null);
    }

    public function createProductProcess()
    {

        $model = new ProductModel();
        $model->mapData($this->router->request->all());
        $model->validate();
        if ($model->errors) {
            Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "Kreiranje proizovda nije uspesno proslo!");
            return $this->view("createProduct", "dashboardd", $model);
        }
        $model->create();
        Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "Uspijesno kreirano");
        return $this->view("createProduct", "dashboardd", $model);

    }

    public function delete()
    {
        $model = new ProductModel();
        $model->mapData($this->router->request->all());
        $model->delete("id = $model->id");
    }

    public function authorize()
    {
        return [
            "Administrator",
            "superAdministrator"
        ];
    }
}