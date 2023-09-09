<?php

namespace app\core;

abstract class Model
{


    //koju validacju i za sta cemo da radimo
    public const RULE_EMIAL= 'email';
    public const RULE_EMIAL_UNIQUE= 'emailUnique';
    public const RULE_REQUIRED= 'required';
    public $errors;




    public function __construct(){

    }

    abstract  public function rules() : array;

    public function validate()
    {

        foreach ($this->rules() as $attribute=>$rules){
            $value=$this->{$attribute};//sintaksa za citanje vrijednosti
            //var_dump($attribute);--prestavlja podatak koji se trazi da se unese i iz ruels funkcije iscitava
            //var_dump($value);exit;

            foreach ($rules as $rule){

                if($rule === self::RULE_REQUIRED){
                    if(!$value){
                       $this->addErrors("$attribute", "$rule");
                    }
                }
                if($rule=== self::RULE_EMIAL){
                    if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                        $this->addErrors("$attribute", "$rule");
                    }

                }
                if($rule === self::RULE_EMIAL_UNIQUE && $this->uniqueEmail($value)){
                    $this->addErrors("$attribute", "$rule");
                }

            }
        }
    }



    public function uniqueEmail($email)
    {
        $db = $this->db->conn();


        $sqlString = "SELECT * FROM users WHERE email = '$email';";

        $dataResult = $db->query($sqlString) or die();

        $result = $dataResult->fetch_assoc();


        if ($result !== null)
            return true;

        return false;


    }

    public function addErrors($attribute, $rule){
        $message = $this->errorMessages()[$rule] ?? '';
        return $this->errors[$attribute][]=$message;
    }
    public function errorMessages(){
        return[
            self::RULE_REQUIRED=>"this filed is ewqured",
            self::RULE_EMIAL=>"this filed is not corect form for email",
            self::RULE_EMIAL_UNIQUE=> "Email already exist",
        ];
    }

    public function mapData($data)

    {
        if($data !== null){
            foreach ($data as $key =>$value){
                if(property_exists($this, $key)){
                    $this->{$key} = $value;
                }
            }
        }
    }
}