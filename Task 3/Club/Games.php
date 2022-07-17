<?php
session_start();
if (is_null($_SESSION['subscriber-name']) || is_null($_SESSION['families'])) {
    header("location:Subscribe.php");
    die;
}
?>
<?php
$Sports = ["football" => 300, "swimming" => 250, "volleyball" => 150, "other" => 100];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MemberErrors = [];
    for ($i = 0; $i < $_SESSION['families']; $i++) {
        if (!array_key_exists("member-sports#" . $i + 1, $_POST)) {
            unset($_SESSION["member-sports#" . $i + 1]);
            for ($y = 0; $y < count($Sports); $y++) {
                $_SESSION["member-sports#" . $i + 1][] = "";
            }
        } else {
            $_SESSION["member-sports#" . $i + 1] = $_POST["member-sports#" . $i + 1];
            $counter = count($_POST["member-sports#" . $i + 1]);
            while ($counter < count($Sports)) {
                $_SESSION["member-sports#" . $i + 1][] = "";
                $counter++;
            }
        }
        if (empty($_POST["member-" . $i + 1]) && $_POST["member-" . $i + 1] != "0") {
            $MemberErrors["member-" . $i + 1] = "<p class = 'text-danger'>The member name is required</p>";
        }else{
            $_SESSION["member-" . $i + 1] = $_POST["member-" . $i + 1];
        }
    }
    if (empty($MemberErrors)) {
        header("location:Result.php");
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Games</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3 w-50">
        <form action="" method="post">
            <?php
            for ($i = 0; $i < $_SESSION['families']; $i++) { ?>
                <div class="form-group">
                    <h4 class="text-primary mb-3 font-weight-bold">Member <?= $i + 1 ?></h4>
                    <input type="text" class="form-control mb-2" name="member-<?= $i + 1 ?>" value="<?= $_SESSION["member-" . $i + 1] ?? "" ?>">
                    <?= $MemberErrors["member-" . $i + 1] ?? "" ?>
                    <?php
                    foreach ($Sports as $key => $value) { ?>
                        <div class="form-check mb-1">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="member-sports#<?= $i + 1 ?>[]" value="<?= $key ?>" <?php
                                                                                                                                        if (array_key_exists("member-sports#" . $i + 1, $_SESSION)) {
                                                                                                                                            foreach ($_SESSION["member-sports#" . $i + 1] as $SportValue) {
                                                                                                                                                if ($SportValue == $key) {
                                                                                                                                                    echo "checked";
                                                                                                                                                    break;
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                        ?>><?= ucfirst($key) ?> <b><?= $value . "LE" ?></b>
                            </label>
                        </div>
                    <?php
                    } ?>
                </div>
            <?php
            }
            ?>
            <button class="btn btn-primary text-center w-100 mb-3">check price</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>