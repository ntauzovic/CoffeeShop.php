<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;
use mysqli;

class RegistrationModel extends DbModel
{
    public string $email ='';
    public string $password='';

    public function rules(): array
    {
        return [
            'email'=>[self::RULE_EMIAL, self::RULE_EMIAL_UNIQUE],
            'password'=>[self::RULE_REQUIRED],
            //'name'=>[self::RULE_REQUIRED], radjeno je na projektu da smo stivili i ime fimre
            //'confirmPassword'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']]
        ];
    }

    public function tableName()
    {
        return "users";
    }

    public function attributes(): array
    {
        return [
            "email",
            "password"
        ];
    }

    public function registration(){
        $this->password= password_hash($this->password, PASSWORD_DEFAULT);
        $this->create();

        $user = new UserModel();
        $role= new RoleModel();
        $userRoles= new userRolesModels();


        $user->mapData($user->one("email= '$this->email'"));
        $role->mapData($role->one("name= 'korisnik'"));
        $userRoles->id= $user->id;
        $userRoles->roles_id = $role->roles_id;
        //var_dump($userRoles);exit;
        $userRoles->create();

    }


}