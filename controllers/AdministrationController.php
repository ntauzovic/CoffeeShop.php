<?php

namespace app\controllers;

use app\core\Controller;
use app\models\OrderModel;
use mysqli;

class AdministrationController extends Controller
{

    public function index(){
        $this->view("admin" ,"dashboardd", null);
    }
    public function users(){

        $this->view("users","dashboardd", null);
    }

    public function getALlUsers(){
        $mysql= new mysqli("localhost", "root", "", "users") or die();

        $db= $mysql->query("select * from users;") or die(mysqli_error($mysql));

        $resultArray=[];
        while ( $result = $db->fetch_assoc()) {
            $resultArray[] = $result;
        }

        echo json_encode($resultArray);
        //return $resultArray;

    }

    public function orders(){
        $dataFrom= $this->router->request->one("dataFrom");
        $dataTo= $this->router->request->one("dataTo");

        $orderModel= new OrderModel();
        $dbData= $orderModel->orders($dataFrom,$dataTo);
        echo json_encode($dbData);
    }
    public function price(){

        $year= $this->router->request->one("year");

        $orderModel= new OrderModel();
        $dbData= $orderModel->price($year);
        echo json_encode($dbData);
    }

    public function quantity(){
        $orderModel= new OrderModel();
        $dbData= $orderModel->quantity();
        echo json_encode($dbData);
    }


    public function authorize()
    {
        return ["superAdministrator"];

    }
}