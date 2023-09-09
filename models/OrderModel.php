<?php

namespace app\models;

use app\core\DbModel;

class OrderModel extends DbModel
{

    public $id;
    public $total_price;
    public $data_created;
    public $user_email;



    public function tableName()
    {
       return "orders";
    }

    public function attributes(): array
    {
        return [
            "total_price",
            "data_created",
            "user_email",


        ];
    }

    public function orders($dataFrom,$dataTo){
        $db = $this->db->conn();


        $dataFrom = $dataFrom == "" ? '2023-01-01:00:00:00':$dataFrom;
        $dataTo = $dataTo == "" ? '2023-02-07:23:59:59':$dataTo;

        $sqlString="SELECT product_id, SUM(quantity) AS quantity_sum, product.name AS name,orders.data_created AS data FROM order_items
    LEFT JOIN product ON order_items.product_id=product.id LEFT JOIN orders ON order_items.order_id = orders.id
            WHERE orders.data_created>='$dataFrom' and orders.data_created<='$dataTo ' GROUP BY product_id;";



        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }


    public function price($year){
        $db = $this->db->conn();

        $year = $year == "" ? 2023:$year;


       $sqlString= "SELECT sum(`total_price`) AS `total_price`, MONTH(`data_created`) AS `mjesec` 
FROM `orders` WHERE YEAR(`data_created`) = '$year' GROUP BY `mjesec` ASC;";
        $dataResult = $db->query($sqlString) or die();


        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function quantity(){
        $db = $this->db->conn();



        $sqlString="SELECT SUM(quantity) AS quantity_sum, product.name AS name FROM order_items
    LEFT JOIN product ON order_items.product_id=product.id LEFT JOIN orders ON order_items.order_id = orders.id GROUP BY name;";




        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }


    public function download(){
        $db = $this->db->conn();



        $sqlString="SELECT SUM(quantity) AS quantity_sum, product.name AS name FROM order_items
    LEFT JOIN product ON order_items.product_id=product.id LEFT JOIN orders ON order_items.order_id = orders.id GROUP BY name;";




        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    //$priceFrom = $priceFrom == "" ? -1:$priceFrom;

    //$year = $year == "" ? 2022:$year;


    //$dataFrom = $dataFrom == "" ? -1:$dataFrom;
    //$dataTo = $dataTo == "" ? 1000000:$dataTo;

}