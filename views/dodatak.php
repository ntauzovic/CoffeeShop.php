<?php

class dodatak
{


    //sta smo obrisali ali moze da posluzi
    /*
    /--<?php
    ispis poruke kad smo pogrijesili prilikom unosta nekih podataka
                $massege= Application::$app->session->getFlash("login");
                if($massege !== false){
                    echo"<h2>$massege</h2>";
                };
            ?>--/
            <

 <label>Company name</label>
            <div class="mb-3">
                <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Company name"
                        aria-label="Company name"
                        aria-describedby="Company name-addon"
                />
                <?php
                if($params !== null && $params->errors !== null){
                    foreach ($params->errors as $nazivPolja=>$item) {
                        if($nazivPolja == "name"){
                            echo"<span class='text-danger'>$item[0]</span>";
                        }
                    }
                }
                ?>
            </div>
    <div class="col-md-6 d-flex justify-content-end">
                        <a href="/product/create" class="btn btn-sm btn-primary me-0">Create new product</a>
                    </div> kreirano za ubacivanje novog producta


    <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        {{renderPartialView}}
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> linija koda 107 micemo sve sto se nalazi na glavnoj pocetnoj strani

        <div class="col">
        <div class="card" style="width:400px" >
            <img src="https://javacoffee.rs/wp-content/uploads/2020/05/006-scaled.jpg" class="card-img-top" style="width:300px" alt="...">
            <div class="card-body" style="width:300px">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width:400px" >
            <img src="https://javacoffee.ba/img/001-scaled.jpg" class="card-img-top" style="width:300px" alt="...">
            <div class="card-body" style="width:300px" >
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width:400px" >
            <img src="https://javacoffee.rs/wp-content/uploads/2020/05/006-scaled.jpg" class="card-img-top" style="width:300px" alt="...">
            <div class="card-body" style="width:300px">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width:400px" >
            <img src="https://javacoffee.ba/img/1-1-300x214.jpg" class="card-img-top" style="width:300px" alt="...">
            <div class="card-body" style="width:300px">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div> prodact



        $(document).ready(function (){
        getRows();

        $("#search-input").change(function (){
            getRows();
        });
    });

    $(document).on('click', '.delete-action', function (){
        alert("test")
        $.get($(this).data("route"), function (result) {

        } {
            getRows();
        });
    });

    $(document).ready(function () {
        function getRows() {
            //$("#table-body").empty();
            //var data = {"search": $("#search-input").val()};
            $.get("/api/product/rows/json", function (result) {
                $.each(JSON.parse(result), function (i, item) {
                    $("#table-body").append(
                        "<tr>" +
                        "<td>" +
                        "<div class='d-flex px-2 py-1'>" +
                        "<div>" +
                        "<img src='" + item.image_url + "' class='avatar avatar-sm me-3' alt='user1'>" +
                        "</div>" +
                        "<div class='d-flex flex-column justify-content-center'>" +
                        "<h6 class='mb-0 text-sm'>" + item.name + "</h6>" +
                        "</div>" +
                        "</div>" +
                        "</td>" +
                        "<td>" +
                        "<p class='mb-0 text-sm'>" + item.price + "</p>" +
                        "</td>" +
                        "<td class='align-middle text-center text-sm'>" +
                        "<p class='mb-0 text-sm'>" + item.description + "</p>" +
                        "</td>" +
                        "<td class='align-middle'>" +
                        "<a href='/product/update?id=" + item.id + "' target='_blank' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user'>" +
                        "Edit" +
                        "</a>" +
                        " | <a href='javascript:' data-router='/product/delet?id" + item.id + "' class='text-secondary font-weight-bold text-xs delete-action' data-toggle='tooltip' data-original-title='Delet product'>" +
                        "Delet" +
                        "</a>" +
                        " | <a href='/product/create' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user'>" +
                        "Create new product" +
                        "</a>" +
                        "</td>" +
                        "</tr>"
                    );
                });
            });
        };
    )};

</script>

    sta je prije bilo u home samo
    <div class="row p-3 mt-5 g-4" id="products_panel">

</div>
<script>
    function getRows(){
        $("#products_panel").empty();
        $.get("/api/product/rows/html", data,  function(result) {
            $.each(JSON.parse(result), function(i, item) {
                $("#table-body").append
            }
        }
    }
</script>


    echo "<button class='add-from-card btn btn-sm btn-outline-secondary'data-id='$cart_item->product_id' data-route='/api/cart/quantity/add'>+</button>";
                                        echo "<button class='quantity btn btn-sm btn-link'>$cart_item->quantity</button>";
                                        echo "<button class='remove-from-card btn btn-sm btn-outline-secondary' data-id='$cart_item->product_id' data-route='/api/cart/quantity/remove'>-</button>";
                                    echo "</td>";



    animation: {
                    onComplete: function () {
                        const download = document.getElementById('download');
                        let a = document.createElement('a');
                        a.href = this.toBase64Image();
                        a.download = 'my_file_name.png';
                        a.innerText='Download';
                        a.style.width="50px";
                        a.style.height="50px";
                        console.log(download.innerHTML);
                        if(download.innerText==""){
                            download.appendChild(a);
                        }
                        //a.click();
                    }
                },

    */
}