<?php
require_once __DIR__ . '/../vendor/autoload.php';


use app\controllers\AdministrationController;
use app\controllers\HomeController;
use app\controllers\ProductController;
use app\controllers\AuthController;
use app\core\Application;
use app\controllers\CartController;

$app= new Application();


$app->router->get("/", [HomeController::class, 'index']);
$app->router->get("/home", [HomeController::class, 'index']);
$app->router->get("/create", [AuthController::class, 'create']);
$app->router->get("/update", [AuthController::class, 'update']);
$app->router->get("/delete", [AuthController::class, 'delete']);
$app->router->get("/login", [AuthController::class, 'login']);
$app->router->get("/registration", [AuthController::class, 'registration']);
$app->router->get("/administration/users", [AdministrationController::class, 'users']);
$app->router->get("/api/administration/users", [AdministrationController::class, 'getAllUsers']);
$app->router->get("/product/create", [ProductController::class, 'create']);
$app->router->get("/product/delete", [ProductController::class, 'delete']);
$app->router->post("/api/cart/add", [CartController::class, 'add']);
$app->router->post("/api/cart/quantity/add", [CartController::class, 'addQuantity']);
$app->router->post("/api/cart/quantity/remove", [CartController::class, 'removeQuantity']);
$app->router->get("/cart", [CartController::class, 'viewCart']);
$app->router->get("/cart/delete", [CartController::class, 'deleteCart']);
$app->router->get("/cart/check", [CartController::class, 'checkCart']);
$app->router->get("/admin", [AdministrationController::class, 'index']);
$app->router->get("/api/orders", [AdministrationController::class, 'orders']);
$app->router->get("/api/prices", [AdministrationController::class, 'price']);
$app->router->get("/api/quantity", [AdministrationController::class, 'quantity']);
$app->router->get("/download", [AdministrationController::class, 'download']);



$app->router->get("/logout", [AuthController::class, 'logout']);
$app->router->get("/accessDenied", [AuthController::class, 'accessDenied']);
$app->router->get("/api/product/rows/json", [ProductController::class, 'rows']);
$app->router->get("/products", [ProductController::class, 'index']);
$app->router->get("/api/product/rows/html", [HomeController::class, 'rows']);


$app->router->post("/registrationProcess", [AuthController::class, 'registracionProcess']);
$app->router->post("/loginProcess", [AuthController::class, 'loginProcess']);
$app->router->post("/createProductProcess", [ProductController::class, 'createProductProcess']);


















//$app->router->get("/create", "create");

//var_dump($app->router->);
$app->run();


