<?php
/** @var $params \app\models\ListProductModel
 */

use app\core\Application;

?>

    <?php
$din="Dinara";

    if($params != null && $params->products !=null)
    {
        foreach ($params->products as $product)
        {
            echo "<div class='col-md-3'>";
            echo "<div class='card'  >";
            echo"<img src='$product->image_url' class='card-img-top' style='width:200px' style='height:200px' alt='...'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>$product->name</h5>";
            echo "<h5 class='card-title'>$product->price $din</h5>";
            if (Application::$app->session->get((Application::$app->session->USER_SESSION))){
                echo "<div class='card-footer p-2 d-flex' style='background-color: red'>";
                echo "<a href='javascript:;' class='btn btn-danger m-0 add-to-cart ' data-id='$product->id' data-route='/api/cart/add'><i class='fas fa-shopping-cart'></i> +</a>";
            }else{
                echo "<div class='card-footer p-2 d-flex ' style='background-color: red'>";
                echo "<a href='javascript:;' class='btn btn-danger m-0 alert '<i class='fas fa-shopping-cart'></i> +</a>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
    ?>

