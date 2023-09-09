<?php

namespace app\models;

use app\core\DbModel;

class UserModel extends DbModel
{
    public  $id;
    public String $first_name;
    public String $last_name;
    public String $email;
    public String $password;
    public $role_names;


    public function tableName()
    {
        return "users";
    }
    public  function rules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return[
            "id",
            "email",
            "password"
        ];

    }
}