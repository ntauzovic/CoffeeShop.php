<div class="row p-3 mt-7 g-5" id="product-panel"></div>

<script>
    $(document).ready(function () {
        $("#products_panel").empty();
        $.get("/api/product/rows/html", function(result) {
            $("#product-panel").append(result);
        });
    });
    $(document).on('click', '.add-to-cart', function () {
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

    $(document).on('click', '.alert', function () {
        //alert("Da bi ste dodali u korpu morate biti ulogovani!");
        alert("If you want to add producst in cart, you must be logged in!")

    });
</script>
