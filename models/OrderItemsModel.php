<?php

namespace app\models;

use app\core\DbModel;

class OrderItemsModel extends DbModel
{

    public $id;
    public $product_id;
    public $price;
    public $order_id;
    public $quantity;

    public function tableName()
    {
        return "order_items";
    }

    public function attributes(): array
    {
       return [
           "product_id",
           "price",
           "quantity",
           "order_id"
       ];
    }
}