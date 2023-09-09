<?php

namespace app\core;

abstract class Controller
{
    public Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->checkRoles();

    }

    public function view($view, $layout, $params)
    {
        return $this->router->view($view, $layout, $params);
    }

    public function partialView($view, $params)
    {
        return $this->router->partialView($view, $params);
    }

    abstract public function authorize();

    public function checkRoles()
    {
        $roles = $this->authorize();
        if ($roles === []) return;
        $access = false;

        $email = Application::$app->session->get(Application::$app->session->USER_SESSION);

        $userRoles = $this->getRoles();
        if ($email !== false) {
            foreach ($roles as $role) {
                foreach ($userRoles as $userRole) {

                    if ($role === $userRole) {
                        $access = true;
                    }
                }
            }
            if (!$access) {
                header("location:" . "/accessDenied");
            }

            return;
        }

        //nedostaju ti dve tacke ovde :D
        header("location:" . "/login");
    }


    public function getRoles(): array
    {
        if (Application::$app->session->get(Application::$app->session->ROLE_SESSION) !== false) {

            return Application::$app->session->get(Application::$app->session->ROLE_SESSION);
        };

        $connection = new dbConnection();
        $email = Application::$app->session->get(Application::$app->session->USER_SESSION);
        $resultFromDb = $connection->conn()->query("
            select * from `users`
            inner join user_roles on users.id=user_roles.id
            inner join roles on user_roles.roles_id = roles.roles_id 
            where users.email='$email'  and roles.active=true;");

        $resultArray = [];
        while ($result = $resultFromDb->fetch_assoc()) {
            $resultArray[] = $result["name"]; // citamo samo name iz te liste
        }


        Application::$app->session->set(Application::$app->session->ROLE_SESSION, $resultArray);
        return $resultArray;
    }
}