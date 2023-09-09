<?php
/** @var $params \app\models\ProductModel
 */

?>
<div class="card card-plain mt-1">
    <div class="card-header pb-0 text-left bg-transparent">
        <h3 class="font-weight-bolder text-info text-gradient">Insert product</h3>
        <p class="mb-0">Insert new coffee name, price and description to insert in</p>
    </div>
    <div class="card-body">
        <form role="form" action="/createProductProcess" method="post">
            <label>Name</label>
            <div class="mb-3">
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="name"
                    aria-label="name"
                    aria-describedby="name-addon"
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
            <label>Image url</label>
            <div class="mb-3">
                <input
                        type="text"
                        name="image_url"
                        class="form-control"
                        placeholder="image_url"
                        aria-label="image_url"
                        aria-describedby="image_url-addon"
                />
                <?php
                if($params !== null && $params->errors !== null){
                    foreach ($params->errors as $nazivPolja=>$item) {
                        if($nazivPolja == "image_url"){
                            echo"<span class='text-danger'>$item[0]</span>";
                        }
                    }
                }

                ?>
            </div>
            <label>Price</label>
            <div class="mb-3">
                <input
                    type="number"
                    name="price"
                    class="form-control"
                    placeholder="price"
                    aria-label="price"
                    aria-describedby="price"
                />
                <?php
                if($params !== null && $params->errors !== null){
                    foreach ($params->errors as $nazivPolja=>$item) {
                        if($nazivPolja == "price"){
                            echo"<span class='text-danger'>$item[0]</span>";
                        }
                    }
                }
                ?>
            </div>
            <label>Desxription</label>
            <div class="mb-3">
                <input
                    type="text"
                    name="description"
                    class="form-control"
                    placeholder="description"
                    aria-label="description"
                    aria-describedby="description"
                />
                <?php
                if($params !== null && $params->errors !== null){
                    foreach ($params->errors as $nazivPolja=>$item) {
                        if($nazivPolja == "description"){
                            echo"<span class='text-danger'>$item[0]</span>";
                        }
                    }
                }
                ?>
            </div>
            <div class="form-check form-switch">
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="rememberMe"
                    checked=""
                />
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                    Insert product
                </button>
            </div>
        </form>
    </div>
    <div class="card-footer text-center pt-0 px-lg-2 px-1">
        <p class="mb-4 text-sm mx-auto">
            Alredy insert?
            <a href="/createProductProcess;" class="text-info text-gradient font-weight-bold"
            >Sign up</a
            >
        </p>
    </div>
</div>
