<?php

namespace app\models;

use app\core\DbModel;

class cartModel extends DbModel
{

    public  array $cart_items = [];
    public $total_price;


    public function tableName()
    {
        return "";
    }

    public function attributes(): array
    {
        return [];
    }
}