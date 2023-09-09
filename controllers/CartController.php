<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\cardItemModel;
use app\models\cartModel;
use app\models\CategoryModel;
use app\models\loginModel;
use app\models\OrderItemsModel;
use app\models\OrderModel;
use app\models\ProductModel;
use app\models\RegistrationModel;
use app\models\ResponseMessageModel;
use app\models\UserModel;


class CartController extends Controller
{

    public function add(){


        $responseModel= new ResponseMessageModel();
        $cartModel= Application::$app->session->get(Application::$app->session->CART_SESSION);


        $productModel= new ProductModel();
        $productModel->mapData($this->router->request->all());
        $productModel->mapData($productModel->one("id = $productModel->id"));



        if($productModel->id === null){
            $responseModel->success = false;
            $responseModel->message = "Proizvod ne postoji";
            echo json_encode($responseModel);
            exit;

        }
        if($cartModel === false){
            $cartModel= new cartModel();
        }

        $alreadyExist = false;
            foreach ($cartModel->cart_items as $cart_item) {
                if ($cart_item->product_id === $productModel->id) {
                    $alreadyExist = true;
                    $cart_item->quantity += 1;
                }
            }



        if(!$alreadyExist){
            $cardItemModel = new cardItemModel();
            $cardItemModel->mapData($productModel);
            $cardItemModel->product_id = $productModel->id;
            //$cardItemModel->price = $productModel->price;
            //$cardItemModel->image_url = $productModel->image_url;
            $cardItemModel->quantity = 1;
            $cartModel->cart_items[]= $cardItemModel;

        }


        $sum = 0;
        if($cartModel != null && $cartModel->cart_items != null){
            foreach ($cartModel->cart_items as $cart_item){
                $sum += ($cart_item->price * $cart_item->quantity ?? 1 );
            }
        }


        $cartModel->total_price= $sum;

        Application::$app->session->set(Application::$app->session->CART_SESSION, $cartModel);



        $responseModel->success = true;
        $responseModel->message = "Proizvod uspijenso dodat";
        //Application::$app->session->setFlash("$cartModel", "Proizvod uspijenso dodat");
        echo json_encode($responseModel);
        exit;


    }

    public function viewCart(){

        $cartModel= Application::$app->session->get(Application::$app->session->CART_SESSION);
        //var_dump($cartModel);exit;

        if($cartModel === false){
            Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_ERROR, "korpa je prazna");
            return $this->view("home", "empty", null);

        }
        $this->view("cart", "empty", null);
    }

    public function addQuantity()
    {
        $productModel = new ProductModel();
        $productModel->mapData($this->router->request->all());
        $productModel->mapData($productModel->one("id = $productModel->id"));
        $cardItemModel = new cardItemModel();
        $cardItemModel->mapData($productModel);
        $cardItemModel->product_id = $productModel->id;
        $cardItemModel->quantity = 1;
        $cartModel = new CartModel;
        $cartModel->cart_items[] = $cardItemModel;
        $sum = 0;
        if ($cartModel != null && $cartModel->cart_items != null) {
            foreach ($cartModel->cart_items as $cart_item) {
                $sum += ($cart_item->price * $cart_item->quantity ?? 1);
            }
        }
        echo $cardItemModel->quantity += 1;
    }



    public function removeQuantity(){

    }
    public function deleteCart(){
        Application::$app->session->remove(Application::$app->session->CART_SESSION);
        return $this->view("home", "empty", null);

    }




    public function getCart(){
        return Application::$app->session->get(Application::$app->session->CART_SESSION);
    }

    public function checkCart(){
       $cart= $this->getCart();

       //$user_id = new loginModel();
       $order= new OrderModel();


       $order->user_email =(Application::$app->session->get(Application::$app->session->USER_SESSION));

       $order->mapData($cart);
       $order->data_created =date("Y-m-d H:i:s");
        //var_dump($order);exit;



        //$order->data_created =date("Y-m-d");

        //$order->user_id = $user_id->id(Application::$app->session->get(Application::$app->session->USER_SESSION));


        $order->create();

        $order->mapData($order->lastCreaet());
        foreach ($cart->cart_items as $cart_item){
            $orderItems= new OrderItemsModel();
            $orderItems->mapData($cart_item);
            $orderItems->order_id = $order->id;

            $orderItems->create();

        }

        Application::$app->session->setFlash(Application::$app->session->FLASH_MESSAGE_SUCCESS, "Uspijensno naruceno");
        $this->deleteCart();
        //header("location:" . "/home");

    }

    public function authorize()
    {
        return[];
    }
}