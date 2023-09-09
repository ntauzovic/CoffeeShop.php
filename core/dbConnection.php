<?php

namespace app\core;

use mysqli;

class dbConnection
{
    public function  conn():mysqli{
        $mysql= new mysqli("localhost", "root", "", "users") or die(mysqli_error($mysql));
        return $mysql;
    }
}