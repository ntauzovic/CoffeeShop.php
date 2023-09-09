<?php

namespace app\models;

use app\core\DbModel;

class loginModel extends DbModel
{

    public int $id;
    public string $email='';
    public string $password='';

    public function rules(): array
    {
        return [
            'email'=>[self::RULE_EMIAL],
            'password'=>[self::RULE_REQUIRED],
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
            "id",
            "email",
            "password"
        ];
    }
    public function login(){
        $result= $this->one("email= '$this->email'");
        if($result != null){
            /*if(password_verify($this->password, $result["password"] )){
                var_dump("login check");exit;
                return true;*/
            return password_verify($this->password, $result["password"]);

        }
        return false;


    }
}