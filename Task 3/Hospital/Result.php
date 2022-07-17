<?php
session_start();
if(is_null($_SESSION['phone'])){
    header("location:Number.php");
    die;
}
if(is_null($_SESSION['Questions'])){
    header("location:Review.php");
    die;
}
?>
<?php
$Questions = [
    "Are you satisfied with the level of cleanliness?",
    "Are you satisfied with the service prices?",
    "Are you satisfied with the nursing service?",
    "Are you satisfied with the level of doctors?",
    "Are you satisfied with the calmness in the hospital?"
];
$TotalPoints = 0;
for ($i = 0; $i < count($_SESSION['Questions']); $i++) {
    $NumberOfQuestion = $i + 1;
    if ($_SESSION['Questions']["Q{$NumberOfQuestion}"] == "good") {
        $TotalPoints += 3;
    } elseif ($_SESSION['Questions']["Q{$NumberOfQuestion}"] == "very-good") {
        $TotalPoints += 5;
    } elseif ($_SESSION['Questions']["Q{$NumberOfQuestion}"] == "execllent") {
        $TotalPoints += 10;
    }
}
$alertMsg = "";
if ($TotalPoints < 25) {
    $alertMsg = "<div class='alert alert-danger text-center w-100'>We will call you later on this phone : {$_SESSION['phone']}</div>";
} else {
    $alertMsg = "<div class='alert alert-success text-center w-100'>Thank You!</div>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Result</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="height: 100vh; display : flex; justify-content : center; align-items : center">
    <div class="container mt-5">
        <h1 class="text-center font-weight-bold text-primary mb-3">Result</h1>
        <table class="table">
            <thead>
                <tr class="row bg-dark text-white font-weight-bold">
                    <th class="col-10">Questions</th>
                    <th class="col-2">Reviews</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  for($i=0;$i<count($Questions);$i++){
                    $NumberOfQuestion=$i+1;
                    ?>
                     <tr class="row text-dark">
                        <td class="col-10"><?=$Questions[$i]?></td>
                        <td class="col-2"><?= $_SESSION['Questions']["Q{$NumberOfQuestion}"] ?></td>
                     </tr>
                  <?php
                }?>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <tr class="row bg-dark text-white font-weight-bold">
                    <th class="col-10">Total Review</th>
                    <th class="col-2"><?= $TotalPoints < 25 ? "Bad" : "Good" ?></th>
                </tr>
            </thead>
        </table>
        <div class="row">
            <?= $alertMsg ?>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>