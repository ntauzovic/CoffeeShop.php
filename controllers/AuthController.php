<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\loginModel;
use app\models\RegistrationModel;

class AuthController extends Controller
{

    public function authorize()
    {

        return [];
    }

    public function registration()
    {

        return $this->router->view("registration", "auth", null);
    }

    public function registracionProcess()
    {
        $registration = new RegistrationModel();
        $registration->mapData($this->router->request->all());
        $registration->validate();


        if ($registration->errors) {

            Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "Niste se uspijeli registrovati");
            return $this->router->view("registration", "auth", $registration);
        }

        $registration->registration();
        Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_SUCCESS, "Uspijenso ste se  registrovati");
        return $this->router->view("login", "auth", null);
    }


    public function login()
    {
        if (Application::$app->session->get(Application::$app->session->USER_SESSION) !== false) {
            header("location:" . "/home");
        }

        return $this->router->view("login", "auth",null);
    }



    public function accessDenied()
    {
        return $this->view("accessDenied", "auth", null);
    }

    public function loginProcess()
    {

        $login = new loginModel();
        $login->mapData($this->router->request->all());
        $login->validate();

        if ($login->errors) {
            return $this->view("login", "auth", $login);
        }

        if ($login->login()) {
            Application::$app->session->set(Application::$app->session->USER_SESSION,$login->email);
            Application::$app->session->setFlash(Application::$app->session->USER_SESSION, $login->email);
            $this->getRoles();
            header("location:" . "/home");
        }

        Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "login nije uspjesno prosao");
        return $this->view("login", "auth", $login);
    }

    public function logout()
    {
        Application::$app->session->remove(Application::$app->session->USER_SESSION);
        Application::$app->session->remove(Application::$app->session->ROLE_SESSION);

        header("location:" . "/login");


    }
}