<?php
session_start();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $errorMsg = [];
    if (empty($_POST['phone']) && $_POST['phone']!="0") {
        $errorMsg['phone'] = "<p class='text-danger'>The phone number is required</p>";
    }
    if (empty($errorMsg)) {
        $_SESSION['phone'] = $_POST['phone'];
        header("location:Review.php");
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Hospital</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="display: flex; justify-content : center;align-items : center; height : 100vh">
    <div class="container w-50">
        <h1 class="text-center text-primary font-weight-bold">Hospital</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?=$_SESSION['phone']??""?>" placeholder="Enter your phone number" aria-describedby="helpId">
                <?= $errorMsg['phone'] ?? "" ?>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100 text-center">Submit</button>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>