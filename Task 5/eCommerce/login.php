<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Login";
include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";

$validation = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST)) {

    $validation->setKey("Email")->setValue($_POST['email'])->
    IsEmpty()->patternChecker("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/"," ")
    ->IsExists("users","email");

    $validation->setKey("Password")->setValue($_POST["password"])->IsEmpty()->patternChecker("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/","");

    if (empty($validation->getFieldsErrors())) {
        $user = new User;
        $user->setEmail($_POST['email']);
        $queryResult = $user->getUserbyEmail();
        if($queryResult->num_rows==1){
            $userData = $queryResult->fetch_object();
            if(password_verify($_POST['password'],$userData->password)){
                 if(! is_null($userData->email_verified_at)){
                       $_SESSION['user']=$userData;
                       $successMsg = "Your login has been successfully wait seconds to go to the next page";
                       header('refresh:5;url=index.php');
                 }else{
                    $_SESSION['verification_email']=$_POST['email'];
                    header("location:verification_code.php");die;
                 }
            }else{
                $errorMsg = "Wrong email or password.. Dont't have an account? <a class = 'text-primary font-weight-bold' href = 'register.php'>Create Account here</a>";
            }
        }else{
            $errorMsg = "Wrong email or password.. Dont't have an account? <a class = 'text-primary font-weight-bold' href = 'register.php'>Create Account here</a>";
        }
        
    }else{
        $errorMsg = "Wrong email or password.. Dont't have an account? <a class = 'text-primary font-weight-bold' href = 'register.php'>Create Account here</a>";
    }
}
?>

<body>
    <?php
    include "layouts/navbar.php";
    include "layouts/breadcrumb.php";
    ?>
    <div class="login-register-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4> <?= $title ?> </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form method="post">
                                            <p class="text-center text-success"><?= $successMsg??""?></p>
                                            <p class="text-center text-danger"><?= $errorMsg??"" ?></p>
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" value="<?=$_POST['email']??"" ?>">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox">
                                                    <label>Remember me</label>
                                                    <a href="#">Forgot Password?</a>
                                                </div>
                                                <button type="submit"><span>Login</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "layouts/footer.php";
    include "layouts/scripts.php";
    ?>