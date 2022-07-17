<?php
session_start();
?>
<?php
$userDataInputNames = ["client-name" => "The username is required", "city" => "The city is required", "products" => "The number of products is required"];
$TableHeadNames = ["Productname", "Price", "Quantity"];
$cities = ["cairo", "giza", "alex", "others"];
$ReceiptData = ["client-name" => "", "city" => "", "Total" => 0, "Discount" => 0, "Total after discount" => 0, "Delivery" => 0, "Net Total" => 0];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $UserDataErrors = [];
    foreach ($userDataInputNames as $InputName => $ErrorText) {
        if (empty($_POST[$InputName]) && $_POST[$InputName] != "0") {
            $UserDataErrors[$InputName] = "<p class='text-danger'>{$ErrorText}</p>";
        } else {
            $_SESSION[$InputName] = $_POST[$InputName];
            if ($InputName != "products") {
                $ReceiptData[$InputName] = $_SESSION[$InputName];
                if ($InputName == "city") {
                    if ($ReceiptData[$InputName] == "giza") {
                        $ReceiptData["Delivery"] = 30;
                    } elseif ($ReceiptData[$InputName] == "alex") {
                        $ReceiptData["Delivery"] = 50;
                    } elseif ($ReceiptData[$InputName] == "others") {
                        $ReceiptData["Delivery"] = 100;
                    }
                }
            }
        }
    }
    if ($_POST['button'] == "receipt" && empty($UserDataErrors)) {
        if (array_key_exists("flag", $_SESSION)) {
            $ProductDataErrors = [];
            $counter = 1;
            for ($i = 0; $i < $_POST['products']; $i++) {
                for ($y = 0; $y < count($TableHeadNames); $y++) {
                    if (!array_key_exists("i{$counter}", $_POST)) {
                        $ProductDataErrors["special-error"] = "<p class = 'text-danger'>You want to see the receipt but you changed the number of products</p>";
                        break;
                    }
                    $_SESSION["product-data"]["i{$counter}"] = $_POST["i{$counter}"];
                    if (empty($_SESSION["product-data"]["i{$counter}"]) && $_SESSION["product-data"]["i{$counter}"] != "0") {
                        $ProductDataErrors["i{$counter}"] = "<p class='text-danger'>This field is required</p>";
                    }
                    $counter++;
                }
            }
        }
    } else {
        unset($_SESSION["flag"]);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Supermarket</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 w-50">
        <h1 class="text-center text-primary font-weight-bold mb-3">Supermarket</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="">Clientname</label>
                <input type="text" name="client-name" id="client-name" class="form-control" value="<?= $_SESSION['client-name'] ?? "" ?>" placeholder="" aria-describedby="helpId">
                <?= $UserDataErrors['client-name'] ?? "" ?>
            </div>
            <div class="form-group">
                <label for="">City</label>
                <select name="city" id="city" class="form-control">
                    <?php
                    for ($i = 0; $i < count($cities); $i++) { ?>
                        <option value="<?= $cities[$i] ?>" <?php
                                                            if (array_key_exists("city", $_SESSION)) {
                                                                if ($_SESSION['city'] == $cities[$i]) {
                                                                    echo "selected";
                                                                }
                                                            } elseif ($i == 0) {
                                                                echo "selected";
                                                            }
                                                            ?>><?= ucfirst($cities[$i]) ?></option>

                    <?php
                    }
                    ?>
                </select>
                <?= $UserDataErrors['city'] ?? "" ?>
            </div>
            <div class="form-group">
                <label for="">Number of products</label>
                <input type="number" name="products" id="products" value="<?= $_SESSION['products'] ?? "" ?>" class="form-control" placeholder="" aria-describedby="helpId" min="1">
                <?= $UserDataErrors['products'] ?? "" ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary text-center w-100" name="button" value="product">Enter products</button>
            </div>
            <?php
            if (array_key_exists("flag", $_SESSION) && empty($ProductDataErrors)) {
                if (array_key_exists("button", $_POST)) {
                    if ($_POST['button'] == "receipt") {
                        $ReceiptData["Total"] = 0;
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <?php
                                    foreach ($TableHeadNames as $value) { ?>
                                        <th class="text-primary"><?= $value ?></th>
                                    <?php
                                    }
                                    ?>
                                    <th class="text-primary">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                for ($i = 0; $i < $_SESSION["products"]; $i++) { ?>
                                    <tr>
                                        <?php
                                        for ($y = 0; $y < count($TableHeadNames); $y++) { ?>
                                            <td><?= $_SESSION["product-data"]["i{$counter}"] ?></td>
                                        <?php
                                            $counter++;
                                        }
                                        $ReceiptData["Total"] += ($_SESSION["product-data"]["i" . $counter - 1] * $_SESSION["product-data"]["i" . $counter - 2]);
                                        ?>
                                        <td><?= $_SESSION["product-data"]["i" . $counter - 1] * $_SESSION["product-data"]["i" . $counter - 2] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        $ReceiptData["Discount"] = 0;
                        if ($ReceiptData["Total"] >= 1000 && $ReceiptData["Total"] < 3000) {
                            $ReceiptData["Discount"] = $ReceiptData["Total"] * 0.1;
                        } elseif ($ReceiptData["Total"] >= 3000 && $ReceiptData["Total"] < 4500) {
                            $ReceiptData["Discount"] = $ReceiptData["Total"] * 0.15;
                        } elseif ($ReceiptData["Total"] >= 4500) {
                            $ReceiptData["Discount"] = $ReceiptData["Total"] * 0.2;
                        }
                        $ReceiptData["Total after discount"] = $ReceiptData["Total"] - $ReceiptData["Discount"];
                        $ReceiptData["Net Total"] = $ReceiptData["Total after discount"] + $ReceiptData["Delivery"];
                        ?>
                        <table class="table">
                            <tbody>
                                <?php
                                foreach ($ReceiptData as $key => $value) { ?>
                                    <tr>
                                        <td class="font-weight-bold"><?= $key ?></td>
                                        <td><?= $value ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                <?php
                    }
                }
            } elseif (empty($UserDataErrors) && !empty($_POST)) {
                $_SESSION['flag'] = 1;
                echo $ProductDataErrors["special-error"] ?? "";
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <?php
                            foreach ($TableHeadNames as $name) { ?>
                                <th><?= $name ?></th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $InputNumber = 1;
                        for ($i = 0; $i < $_POST['products']; $i++) { ?>
                            <tr>
                                <?php
                                for ($y = 0; $y < count($TableHeadNames); $y++) { ?>
                                    <td>
                                        <div class="form-group">
                                            <input type="<?= ($y == 0) ? "text" : "number" ?>" name="i<?= $InputNumber ?>" id="i<?= $InputNumber ?>" value="<?= $_SESSION["product-data"]["i{$InputNumber}"] ?? "" ?>" class="form-control" placeholder="" aria-describedby="helpId" min="<?= ($TableHeadNames[$y] == "Price") ? "0" : "1" ?>">
                                            <?= $ProductDataErrors["i{$InputNumber}"] ?? "" ?>
                                        </div>
                                    </td>
                                <?php
                                    $InputNumber++;
                                }
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="button" value="receipt" class="btn btn-primary w-100 text-center mb-2">Receipt</button>
            <?php
            } else {
                unset($_SESSION['flag']);
            }
            ?>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>