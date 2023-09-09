<?php

namespace app\core;


class Application
{
    public Router $router;
    public static Application $app;
    public Session $session;

    public function __construct()
    {
        $this->router = new Router();
        $this->session= new Session();
        self::$app=$this;
    }
    //public static Application  $app;

    public function run(){
        $this->router->resolve();
    }

}