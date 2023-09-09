<?php
/** @var $params \app\models\ProductModel
 */

?>
<div class="card card-plain mt-1">
    <div class="card-header pb-0 text-left bg-transparent">
        <div class="row ">
            <div class="col-md-4">
                <h3 class="font-weight-bolder text-info text-gradient">Report</h3>
            </div>
            <div class="col-md-6">
                <div class="row" >
                    <div class="col-md-4">
                        <input type="date" class="form-control data-range" id="data-from" >
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control data-range" id="data-to">

                    </div>
                    <div class="col-md-3" >
                        <button class="date_button ">Run it</button>

                    </div>
                    <div class="col-md-1" >
                        <button><a download="quantity.json" href="/download" id="order-data">Download </a></button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div>
            <div id="order-panel" style="width: 760px" >
                <canvas id="orders"
                        style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;
                        display: block; width: 634px;"  width= "434px" height="350"
                        class="chartjs-render-monitor "></canvas>
            </div>
        </div>
    </div>
</div>
<div class="card card-plain mt-1">
    <div class="card-body">
        <div id="quantity-panel" style="width: 760px" >
            <canvas id="quantity"
                    style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;
                       display: block; width: 634px;"  width= "634px" height="350"
                    class="chartjs-render-monitor ">
            </canvas>
            <button><a download="quantity.json" href="/download" id="quantity-data">Download </a></button>
        </div>
    </div>
</div>
<div class="card card-plain mt-1">
    <div class="card-header pb-0 text-left bg-transparent">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-6">
                    <input type="text" class="form-control"  id="year" placeholder="Unesite godinu ">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <div id="price-panel" style="width: 760px" >
                <canvas id="price"
                        style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;
                       display: block; width: 634px;"  width= "634px" height="350"
                        class="chartjs-render-monitor ">
                </canvas>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        orders();

        $(".date_button").click(function (){

            $("#order-panel").empty();
            $("#order-panel").append(
                '<canvas id="orders"'+
                'style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;display: block; width: 634px;"'+
                'width= "634"  height="250" class="chartjs-render-monitor"></canvas>');
            orders();
        });
    });


    function orders(){
        var ordersUrl= "/api/orders"

        var data={"dataFrom": $("#data-from").val(), "dataTo":$("#data-to").val() }
        $.getJSON(ordersUrl, data, function (result){
            document.querySelector('#order-data').setAttribute(`href`,`data:application/json,${JSON.stringify(result)}`);
            var labels = result.map(function (e){
                return e.name;

            });

            var dataValues = result.map(function (e){
                return e.quantity_sum;
            });

            var graph = $("#orders").get(0).getContext('2d');

            createGraph(dataValues, labels, graph, "Sales of each product in the order interval", "The quantity of the product sold", "bar");
        });
    }



    $(document).ready(function (){
        price();


        $("#year").change(function (){

            $("#price-panel").empty();
            $("#price-panel").append(
                '<canvas id="price"'+
                'style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;display: block; width: 634px;"'+
                'width= "634"  height="250" class="chartjs-render-monitor"></canvas>');
            price();

        });
    });


    function price(){
        var priceUrl= "/api/prices"
        var data={"year": $("#year").val() }
        console.log(data);
        $.getJSON(priceUrl, data, function (result){

            var labels = result.map(function (e){

                if(e.mjesec == 1){
                    e.mjesec=("Januar")
                }
                else if(e.mjesec == 2){
                    e.mjesec=("Februar")
                }
                else if(e.mjesec == 3){
                    e.mjesec=("Mart")
                }
                else if(e.mjesec == 4){
                    e.mjesec=("April")
                }
                else if(e.mjesec == 5){
                    e.mjesec=("Maj")
                }
                else if(e.mjesec == 6){
                    e.mjesec=("Jun")
                }
                else if(e.mjesec == 7){
                    e.mjesec=("Jul")
                }
                else if(e.mjesec == 8){
                    e.mjesec=("Avgust")
                }

                else if(e.mjesec == 9){
                    e.mjesec=("Septembar")
                }
                else if(e.mjesec == 10){
                    e.mjesec=("Oktobar")
                }
                else if(e.mjesec == 11){
                    e.mjesec=("Novembar")
                }
                else{
                    e.mjesec=("Decembar")
                }

                 return e.mjesec;
            });

            var dataValues = result.map(function (e){
                return e.total_price;
            });

            var graph = $("#price").get(0).getContext('2d');

            createGraphPrice(dataValues, labels, graph, " Monthly turnover report","Total earnings per month", "line");
        });
    }



    function createGraph(dataValues, labels, graph, dataSetLabel, reportLabel, type ){
        new Chart(graph, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    label: dataSetLabel,
                    backgroundColor: 'rgb(173, 5, 5)',
                    borderColor: 'rgb(173, 5, 5)',
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: reportLabel
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            max: 100,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: true
                }
            }
        });
    }




    function createGraphPrice(dataValues, labels, graph, dataSetLabel, reportLabel, type ){
        new Chart(graph, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    label: dataSetLabel,
                    backgroundColor: 'rgb(173, 5, 5)',
                    borderColor: 'rgb(173, 5, 5)',
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: reportLabel
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            max: 300000,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: true
                }
            }
        });
    }



    $(document).ready(function (){
        quantity();
    });

    function quantity(){
        var ordersUrl= "/api/quantity"



        $.getJSON(ordersUrl, function (result){
            document.querySelector('#quantity-data').setAttribute(`href`,`data:application/json,${JSON.stringify(result)}`);
            var labels = result.map(function (e){
                return e.name;

            });


            var dataValues = result.map(function (e){
                return e.quantity_sum;
            });

            var barColors = [
                "#b91d1d",
                "#44ab00",
                "#532b97",
                "#b9e8bf",
                "#1e6571",
                "#a2b647",
                "#368cab",
                "#e8b9d9",
                "rgba(185,232,205,0.9)",
                "#711e54",
                "#e8c9b9",
                "#1e714e"
            ];

            var graph = $("#quantity").get(0).getContext('2d');

            createGraphQuantity(dataValues, labels, graph,barColors, "Sales of each product in the order interval", "The quantity of the product sold", "doughnut");
        });
    }

    function createGraphQuantity(dataValues, labels, graph,barColors, dataSetLabel, reportLabel, type ){
        new Chart(graph, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    label: dataSetLabel,
                    backgroundColor: barColors,

                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: reportLabel
                },
                legend: {
                    display: true
                }
            }
        });
    }

</script>
