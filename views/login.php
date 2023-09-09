<?php
/** @var $params \app\models\loginModel
*/
use app\core\Application;
?>
<link href="../assets/js/plugins/toastr/toastr.min.css" rel="stylesheet" />

<div class="card card-plain mt-8">
    <div class="card-header pb-0 text-left bg-transparent">
        <h3 class="font-weight-bolder text-info text-gradient">Welcome </h3>
        <p class="mb-0">Enter your email and password to sign in</p>
    </div>
    <div class="card-body">
        <form role="form" action="/loginProcess" method="post">
            <label>Email</label>
            <div class="mb-3">
                <input
                        type="text"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                        aria-label="Email"
                        aria-describedby="email-addon"
                />
                <?php
                if($params !== null && $params->errors !== null){
                    foreach ($params->errors as $nazivPolja=>$item) {
                        if($nazivPolja == "email"){
                            echo"<span class='text-danger'>$item[0]</span>";
                        }
                    }
                }

                ?>
            </div>
            <label>Password</label>
            <div class="mb-3">
                <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        aria-label="Password"
                        aria-describedby="password-addon"
                />
                <?php
                if($params !== null && $params->errors !== null){
                    foreach ($params->errors as $nazivPolja=>$item) {
                        if($nazivPolja == "password"){
                            echo"<span class='text-danger'>$item[0]</span>";
                        }
                    }
                }
                ?>
            </div>
            <div class="text-center">
                <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                    Sign in
                </button>
            </div>
        </form>
    </div>
    <div class="card-footer text-center pt-0 px-lg-2 px-1">
        <p class="mb-4 text-sm mx-auto">
            Alredy registred?
            <a href="/registration" class="text-info text-gradient font-weight-bold"
            >Sign in</a
            >
        </p>
    </div>
</div>

