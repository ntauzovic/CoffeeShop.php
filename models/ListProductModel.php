<?php

namespace app\models;

use app\core\DbModel;

class ListProductModel extends DbModel
{

    public $products;
    public $pageIndex;
    public $roleNumbers;
    public $search;

    public  function search()
    {

        $db=$this->db->conn()->query("
SELECT p.id as 'id', p.name as 'name', p.image_url as 'image_url', p.price as 'price',
        p.description as 'description' from `product` p WHERE p.name LIKE '%$this->search%'and p.image_url LIKE 'http%';");


        $resultArray=[];
        while ( $result = $db->fetch_assoc()) {
            $product= new ProductModel();
            $product->mapData($result);
            $resultArray[] = $product;

        }
        $this->products = $resultArray;
        return json_encode($this);
    }
    public  function searchData()
    {

        $db=$this->db->conn()->query("
SELECT p.id as 'id', p.name as 'name', p.image_url as 'image_url', p.price as 'price',
        p.description as 'description' from `product` p WHERE p.name LIKE '%$this->search%'and p.image_url LIKE 'http%';");


        $resultArray=[];
        while ( $result = $db->fetch_assoc()) {
            $product= new ProductModel();
            $product->mapData($result);
            $resultArray[] = $product;

        }
        $this->products = $resultArray;
        return $this;
    }


    public function tableName()
    {
        return "";
    }

    public function attributes(): array
    {

        return [];
    }
}