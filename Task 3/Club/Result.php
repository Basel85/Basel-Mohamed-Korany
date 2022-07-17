<?php
session_start();
if (is_null($_SESSION['subscriber-name']) || is_null($_SESSION['families'])) {
    header("location:Subscribe.php");
    die;
}
?>
<?php
$Sports = ["football" => 300, "swimming" => 250, "volleyball" => 150, "other" => 100];
$Sports_Subscriptions_Count = [];
foreach ($Sports as $key => $value) {
    $Sports_Subscriptions_Count[$key] = 0;
}
$Sports_Subscriptions_sum = 0;
?>
<!doctype html>
<html lang="en">

<head>
    <title>Result Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <table class="table" style="border-top-color : transparent">
            <thead>
                <tr>
                    <th>Subscriber</th>
                    <th class="font-weight-bold"><?= $_SESSION['subscriber-name'] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < $_SESSION['families']; $i++) { ?>
                    <tr>
                        <td><?= $_SESSION["member-" . $i + 1] ?></td>
                        <?php
                        $Total_Club_Subscriptions = 0;
                        foreach ($_SESSION["member-sports#" . $i + 1] as $SportValue) {
                            if ($SportValue != "") {
                                $Total_Club_Subscriptions += $Sports[$SportValue];
                                $Sports_Subscriptions_Count[$SportValue]++;
                            }
                        ?>
                            <td><?= $SportValue ?></td>
                        <?php
                        }
                        $Sports_Subscriptions_sum += $Total_Club_Subscriptions;
                        ?>
                        <td>
                            <?= $Total_Club_Subscriptions . " LE" ?>
                        </td>
                    </tr>
                <?php
                } ?>
                <tr>
                    <td class="font-weight-bold">Total</td>
                    <?php
                    for ($i = 0; $i < count($Sports); $i++) { ?>
                        <td></td>
                    <?php
                    }
                    ?>
                    <td class="font-weight-bold"><?= $Sports_Subscriptions_sum . " LE" ?></td>
                </tr>
            </tbody>
        </table>
        <h1 class="text-center text-primary mb-3">Sports</h1>
        <table class="table">
            <tbody>
                <?php
                foreach ($Sports as $key => $value) { ?>
                    <tr>
                        <td class="font-weight-bold"><?= ucfirst($key) . " club" ?></td>
                        <td><?= $Sports_Subscriptions_Count[$key] * $value . " LE" ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tr>
                <td class="font-weight-bold">Club Subscribtion</td>
                <td><?= $_SESSION['total-subscription'] . " LE" ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Total price</td>
                <td><?= $_SESSION['total-subscription'] + $Sports_Subscriptions_sum . " LE" ?></td>
            </tr>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>