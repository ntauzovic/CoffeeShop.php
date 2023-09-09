<?php

namespace app\core;

abstract class DbModel extends Model
{

    public dbConnection $db;

    abstract public function tableName();
    abstract public function attributes(): array;

    public function __construct(){
        $this->db = new dbConnection();// moze biti greska $this->
    }

    public function rules():array{
        return [];
    }

    public function create(){
        $tableName=$this->tableName();
        $attributes=$this->attributes();
        $values=array_map(fn($attr)=>":$attr",$attributes); //kopija niza attributes i samo dodaje dvije : na kraju
        $sqlString="INSERT INTO $tableName (" .implode(',', $attributes).") VALUES(" .implode(',', $values).")";
        foreach ($attributes as $attribute){
            $sqlString= str_replace(":$attribute", is_numeric($this->{$attribute}) ? $this->{$attribute} : '"'.$this->{$attribute} .'"',$sqlString);
        }
        $this->db->conn()->query($sqlString);
    }

    public function one($where){
        $tableName=$this->tableName();
        $sqlString = "SELECT * FROM $tableName WHERE $where limit 1;";
        $dbResult=$this->db->conn()->query($sqlString);
        return $dbResult->fetch_assoc();
    }
    public function lastCreaet(){
        $tableName=$this->tableName();
        $sqlString = "SELECT * FROM $tableName order by id desc limit 1;";
        $dbResult=$this->db->conn()->query($sqlString);
        return $dbResult->fetch_assoc();
    }

    //treba funkcija koja ce vratiti podatke za pie chart

    public function delete($where)
    {
        $tableName = $this->tableName();

        $sqlString = "DELETE FROM $tableName WHERE $where;";
        $db= $this->db->conn()->query($sqlString);

        return true;
    }
    public function all(){
        $tableName=$this->tableName();
        //$db=$this->db->conn();
        $sqlString = "SELECT * FROM $tableName;";
        $dataResult=$this->db->conn()->query($sqlString);

        $resultArray= [];
        while ($result= $dataResult->fetch_assoc()){
            array_push($resultArray,$result);
        }
        return $resultArray;

    }

}