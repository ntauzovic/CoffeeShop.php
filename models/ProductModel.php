<?php

namespace app\models;

use app\core\DbModel;

class ProductModel extends DbModel
{
    public  $id;
    public  $name;
    public  $image_url;
    public  $price;
    public  $description;


    public function rules(): array{
        return [
            "name" =>[self::RULE_REQUIRED],
            "image_url" =>[self::RULE_REQUIRED],
            "price" =>[self::RULE_REQUIRED]

        ];
    }

    public function tableName()
    {
        return "product";
    }

    public function attributes(): array
    {
        return[
            "name",
            "price",
            "image_url",
            "description",

        ];
    }
}