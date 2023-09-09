<?php

namespace app\core;

class Router
{

    public Request $request;
    public array $routes=[];


    public function __construct()
    {
        $this->request = new Request();

    }
    public function post($path,$callback){
        $this->routes["post"][$path]= $callback;
    }
    public function get($path,$callback){
        $this->routes["get"][$path]= $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback= $this->routes[$method][$path] ?? false;

        if($callback===false){
            http_response_code(response_code:404);
            echo $this->partialView(viewName:"notFound", params: null);
            exit;
        }

        if(is_array($callback)){
            $callback[0]= new $callback[0]();
            // new "app\controllers\UserController"
            return  call_user_func($callback);

        }
        //ovaj dio koda uzima dio koji je naveden u index i to sto je navedeno trazi u
        // navedenom controleru i poziva nju i ona se izvrsava.Izvrsava se odredjeni dok i ispisuje se

        if(is_string($callback)){
            echo $this->partialView($callback,null);
        }
        //kada se unese neki string da se on trazi u view funckiji koja ga prihvata i obradjuje i trazi
        //u folderu naziv viewa kao je se nalazi u callbacku


        //return $this->view($callback); //moze ovdje i echo da se koristi i da samo vrati bez ikakvog rendera

        //echo $this->view($callback);
    }



    public  function layout($layout)
    {
        ob_start();
        include_once __DIR__ . "/../views/layouts/$layout.php";
        return ob_get_clean();
    }
    public function partialView($viewName,$params){

        if($params !==null){
            foreach ($params as $key=>$value){
                $$key=$value;
            }
        }
        ob_start();
        include_once __DIR__ . "/../views/$viewName.php";
        return ob_get_clean();
    }

    public function navBar(){

        $navBar ="korisnikNavBar";
        $roles = Application::$app->session->get(Application::$app->session->ROLE_SESSION);

        if ($roles !== false)
        {
            foreach ($roles as $role)
            {
                if ($role == "Administrator")
                    $navBar = "administratorNavBar";
                if ($role == "superAdministrator")
                    $navBar = "superAdministratorNavBar";

            }
        }

        ob_start();
        include_once __DIR__ . "/../views/components/$navBar.php";
        return ob_get_clean();
    }



    public function view($viewName,$layout,$params)
    {
        $layoutContent = $this->layout($layout);
        $viewContent = $this->partialView($viewName,$params);
        $navBarContent = $this->navBar();


        $view = str_replace("{{renderPartialView}}", $viewContent, $layoutContent);
        $view = str_replace("{{ renderNavBar }}", $navBarContent, $view);
        echo $view;
    }



}