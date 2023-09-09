<?php

namespace app\controllers;

use app\core\Application;
use app\core\Constants;
use app\core\Controller;
//use app\core\Router;
use app\models\loginModel;
use app\models\RegistrationModel;


class UserController extends Controller
{

    /*public Router $router;


    public function __construct(){
        $this->router = new Router();
    }

    public function index(){


        echo "index page";
    }
     ovo smo makli zato sto smo u controler u coru napravili i kad on extenduje ne treba da bude router kalasa pozivnaa
    */


    public function registration(){

        return $this->router->view("registration", "auth", null);
    }

    public function registracionProcess(){
        $registration = new RegistrationModel();
        $registration->mapData($this->router->request->all());


        $registration->validate();


        if($registration->errors){
            return $this->router->view("registration", "auth", $registration);
        }

        $registration->registration();
        return $this->router->view("registration", "auth", null);
    }


    public function login(){
       if(Application::$app->session->get(Application::$app->session->USER_SESSION) !=false){
           header("location:" ."/home");
        }

        return $this->router->view(viewName:"login", layout:"auth", params: null);
    }

    public function accessDenied(){
        if(Application::$app->session->get(Application::$app->session->USER_SESSION) !== false){
            header("location:" ."/accessDenied");
        }

        return $this->router->view(viewName:"accessDenied", layout:"auth");

    }

    public function loginProcess(){

        $login = new loginModel();
        $login->mapData($this->router->request->all());
        $login->validate();

        if($login->errors){
            return $this->view("login", "auth", $login);
        }


        if($login->login()){
            $this->getRoles();

            ///var_dump(Application::$app->session->get(Application::$app->session->USER_SESSION));
            Application::$app->session->set(Application::$app->session->USER_SESSION, $login->email);
            $this->getRoles();
            header("location:" ."/home");


        }
        header("location:" ."/login");
        Application::$app->session->setFlash("login", "login nije uspjesno prosao");
        return $this->view("login","auth", $login);
    }

    public function logout(){
        Application::$app->session->remove(Application::$app->session->USER_SESSION);
        return $this->router->view("login", "auth", null);
}

    public function authorize()
    {
        return[
        ];
    }
}