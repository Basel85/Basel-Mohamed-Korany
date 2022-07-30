<?php
$title = "Verify the account";
include "layouts/header.php";
use App\Http\Requests\Validation;
use App\Database\Models\User;
$validation = new Validation;
if($_SERVER['REQUEST_METHOD']=="POST" && !empty($_POST)){

    $validation->setKey("Verification code")->setValue($_POST['verification_code'])->
    IsEmpty()->patternChecker('/^[0-9]{6}$/')->IsExists("users","verification_code");
     
     if(empty($validation->getFieldsErrors())){
         $user = new User;
         $user->setVerification_code($_POST['verification_code'])->setEmail($_SESSION['verification_email']);
         $queryResult = $user->checkCode();
         if($queryResult->num_rows==0){
            $errorMsg = "<div class = 'alert alert-danger text-center'> Wrong verification code </div>";
         }else{
            $user->setEmail_verified_at(date("Y-m-d H:i:s"));
            if($user->emailVerification()){
                $successMsg = "<div class = 'alert alert-success text-center'> 
                The email has been verified successfully wait to go to the next page </div>";
                $_SESSION['user']=$queryResult->fetch_object();
                unset($_SESSION['verification_email']);
                header('refresh:5;url=index.php');
            }else{
                $errorMsg = "<div class = 'alert alert-danger text-center'> Something went wrong </div>";
            }
         }
     }
}
?>
<body>
    <div class="login-register-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a data-toggle="tab" href="#lg2">
                                <h4> <?=$title?> </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg2" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="#" method="post">
                                            <?=$successMsg ?? ""?>
                                            <?=$errorMsg ?? ""?>
                                            <label for="verification_code">Verification code</label>
                                            <input type="numbrt" name="verification_code" id="verification_code" value="<?=$_POST['verification_code']??""?>">
                                            <?= $validation->getErrorMsg("Verification code")??""?>
                                            <div class="button-box mt-5">
                                                <button type="submit"><span>Verify</span></button>
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
    include "layouts/scripts.php";
    ?>