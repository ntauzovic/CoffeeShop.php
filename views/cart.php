<?php
/** @var $params \app\models\cartModel
 */

use app\core\Application;

$params = Application::$app->session->get(Application::$app->session->CART_SESSION);

?>


<div class="row p-3 mt-5 g-5">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Cart idem</h6>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="/cart/check" class="btn btn-sn btn btn-danger">Check cart</a>
                    </div>
                    <div class=" d-flex justify-content-end">
                        <a href="/cart/delete" class="btn btn-sn btn btn-danger">Delete items</a>
                    </div>
                    <div class=" d-flex justify-content-end">
                        <a href="" class="btn btn-sn  btn-danger">Total price:
                            <?php
                            echo "<h6 class='mb-0 text-sm'> $params->total_price</h6>";
                            ?>
                        </a>

                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>

                        </tr>
                        </thead>
                        <tbody id="table-body">
                        <?php

                        if($params != null && $params->cart_items !=null)
                        {
                            foreach ($params->cart_items as $cart_item )
                            {
                                echo"<tr>";
                                    echo "<td>";
                                    echo "<div class='d-flex px-2 py-1'>";
                                    echo "<div>";
                                    echo "<img src='$cart_item->image_url' class='avatar avatar-sm me-3' alt='user1'>";
                                    echo "</div>";
                                    echo "<div class='d-flex flex-column justify-content-center'>";
                                    echo "<h6 class='mb-0 text-sm'>  $cart_item->name</h6>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo" <p class='mb-0 text-sm'>  $cart_item->price </p>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<button class='quantity btn btn-sm btn-link'>$cart_item->quantity</button>";
                                    echo "</td>";
                                    echo "<td>";

                                    if($params != null && $params->cart_items != null){
                                        foreach ($params->cart_items as $cart_item){
                                            //$sum += ($cart_item->price * $cart_item->quantity ?? 1 );
                                        }
                                    }
                                    $params->total_price;
                                    echo "</td>";
                                echo"</tr>";
                            }

                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    /*const buttonAdd= document.querySelector('.add-from-card').addEventListener("click",function (){

        const countItem= document.querySelector('.quantity')
        countItem.innerHTML= countItem.innerHTML+;

    })

    $(document).on('click', '.remove-from-card', function () {
        var productId=$(this).data("id");
        var route = $(this).data("route");
        var data={"id": productId}
        $.post(route, data, function (result){

            var jsonResult = JSON.parse(result);
            if(jsonResult.success === true){
                toastr.success(jsonResult.message);

            }
            if(!jsonResult.success === false){
                toastr.error(jsonResult.message);
            }


        });
    });
    $(document).on('click', '.add-from-card', function () {
        var productId=$(this).data("id");
        var route = $(this).data("route");
        var data={"id": productId}
        $.post(route, data, function (result){
            var jsonResult = JSON.parse(result);
            if(jsonResult.success === true){
                toastr.success(jsonResult.message);

            }
            if(!jsonResult.success === false){
                toastr.error(jsonResult.message);
            }


        });
    });*/
</script>


