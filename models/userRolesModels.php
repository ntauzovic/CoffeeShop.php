<?php

namespace app\models;

use app\core\DbModel;

class userRolesModels extends DbModel
{

    public $user_roles_id;
    public $roles_id;
    public $id;

    public function tableName()
    {
        return "user_roles";
    }

    public function attributes(): array
    {
       return [
           "id",
           "roles_id"

       ];
    }
}