<?php
  session_start();
  if(is_null($_SESSION['phone'])){
    header("location:Number.php");
    die;
  }
?>
<?php

$TableHeadTitles = ["Questions", "bad", "good", "very-good", "execllent"];

$Questions = [
    "Are you satisfied with the level of cleanliness?",
    "Are you satisfied with the service prices?",
    "Are you satisfied with the nursing service?",
    "Are you satisfied with the level of doctors?",
    "Are you satisfied with the calmness in the hospital?"
];
 if($_SERVER['REQUEST_METHOD']=="GET" && !empty($_GET)){
    $_SESSION['Questions']=$_GET;
    header("location:Result.php");
 }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Review</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-primary font-weight-bold mb-3">Review</h1>
        <form action="" method="get">
            <table class="table  table-striped  w-100">
                <thead>
                    <tr class="row align-items-center">
                        <?php
                        for ($i = 0; $i < count($TableHeadTitles); $i++) {
                            if ($i == 0) { ?>
                                <th class="col-4"><?= $TableHeadTitles[$i] ?></th>
                            <?php
                            } else { ?>
                                <th class="col-2 text-center"><?= $TableHeadTitles[$i] ?></th>
                        <?php
                            }
                        } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($Questions); $i++) { ?>
                        <tr class="row align-items-center">
                            <?php
                            for ($y = 0; $y < count($Questions); $y++) {
                                $NumberOfQuestion=$i+1;
                                if ($y == 0) { ?>
                                    <td class="col-4"><?= $Questions[$i] ?></td>
                                <?php
                                } else { ?>
                                    <td class="col-2 text-center">
                                        <input type="radio" name="Q<?= $i + 1?>" value="<?=$TableHeadTitles[$y]?>" 
                                        <?php
                                         if(array_key_exists("Questions",$_SESSION)){
                                            if($_SESSION['Questions']["Q{$NumberOfQuestion}"]==$TableHeadTitles[$y]){
                                                echo "checked";
                                            }else{
                                                echo "";
                                            }
                                         }else{
                                            if($y==1){
                                                echo "checked";
                                            }else{
                                                echo "";
                                            };
                                         }?>>
                                    </td>
                            <?php
                                }
                            } ?>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
            <div class="form-group row">
                <button class="btn btn-primary text-center w-100 ">Review</button>
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