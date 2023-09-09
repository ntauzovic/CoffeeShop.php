<?php

namespace app\models;

use app\core\DbModel;

class cardItemModel extends DbModel
{

    public $product_id;
    public $price;
    public $name;
    public $quantity;
    public $image_url;
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