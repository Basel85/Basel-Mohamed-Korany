<?php
$title = "Register";
include "layouts/header.php";
include "App/Http/Middlewares/Guest.php";
use App\Http\Requests\Validation;
use App\Database\Models\User;

$validation = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST)) {
    $validation->setKey("First Name")->setValue($_POST['first_name'])->IsEmpty()->IsString()->maxLengthChecker(32);

    $validation->setKey("Last Name")->setValue($_POST['last_name'])->IsEmpty()->IsString()->maxLengthChecker(32);

    $validation->setKey("Email")->setValue($_POST["email"])->IsEmpty()
        ->patternChecker("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/")
        ->maxLengthChecker(64)->minLengthChecker(10)->IsUnique('users', 'email');

    $validation->setKey("Phone")->setValue($_POST["phone"])->IsEmpty()->patternChecker("/^01[0125][0-9]{8}$/")->maxLengthChecker(11)->minLengthChecker(11)->IsUnique('users', 'phone');

    $validation->setKey("Password")->setValue($_POST["password"])->IsEmpty()->patternChecker("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/")->IsConfirmed($_POST["password_confirmation"])->maxLengthChecker(255)->minLengthChecker(8);

    $validation->setKey("Password Confirmation")->setValue($_POST["password_confirmation"])->IsEmpty();
    $validation->setKey("Gender")->setValue($_POST["gender"])->IsEmpty()->isInside(["m", "f"]);

    if (empty($validation->getFieldsErrors())) {
        $user = new User;
        $verification_code = rand(100000, 999999);
        $user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])->setEmail($_POST["email"])
            ->setPhone($_POST["phone"])->setPassword($_POST["password"])->setGender($_POST["gender"])
            ->setVerification_code($verification_code);
        if ($user->create()) {
            $_SESSION['verification_email']=$_POST['email'];
            header("location:verification_code.php?");die;
        } else {
            $error = "<div class = 'alert alert-danger text-center'>Something Went Wrong</div>";
        }
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
                            <a data-toggle="tab" href="#lg2">
                                <h4> <?= $title ?> </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg2" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <?= $error ?? "" ?>
                                        <form action="#" method="post">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="first_name" value="<?= $_POST['first_name'] ?? "" ?>">
                                            <?= $validation->getErrorMsg("First Name") ?? "" ?>
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" value="<?= $_POST['last_name'] ?? "" ?>">
                                            <?= $validation->getErrorMsg("Last Name") ?? "" ?>
                                            <label for="email">Email</label>
                                            <input name="email" type="email" id="email" value="<?= $_POST['email'] ?? "" ?>">
                                            <?= $validation->getErrorMsg("Email") ?? "" ?>
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" name="phone" id="phone" value="<?= $_POST['phone'] ?? "" ?>">
                                            <?= $validation->getErrorMsg("Phone") ?? "" ?>
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? "" ?>">
                                            <?= $validation->getErrorMsg("Password") ?? "" ?>
                                            <label for="password_confirmation">Confirm your password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" value="<?= $_POST['password_confirmation'] ?? "" ?>">
                                            <?= $validation->getErrorMsg("Password Confirmation") ?? "" ?>
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option <?= isset($_POST['gender']) && $_POST['gender'] == 'm' ? 'selected' : '' ?> value="m">Male</option>
                                                <option <?= isset($_POST['gender']) && $_POST['gender'] == 'f' ? 'selected' : '' ?> value="f">Female</option>
                                            </select>
                                            <?= $validation->getErrorMsg("Gender") ?? "" ?>
                                            <div class="button-box mt-5">
                                                <button type="submit"><span>Register</span></button>
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