<?php
session_start();
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $errors = [];
  if (empty($_POST['user-name']) && $_POST['user-name'] != "0") {
    $errors['user-name'] = "<p class='text-danger'>The username is required</p>";
  }else{
    $_SESSION['user-name'] = $_POST['user-name'];
  }
  if (empty($_POST['loan-amount'])) {
    $errors['loan-amount'] = "<p class='text-danger'>The loan amount is required</p>";
  }else{
    $_SESSION['loan-amount'] = $_POST['loan-amount'];
  }
  if (empty($_POST['loan-years'])) {
    $errors['loan-years'] = "<p class='text-danger'>The loan years is required</p>";
  }else{
    $_SESSION['loan-years'] = $_POST['loan-years'];
  }
  if (empty($errors)) {
    $Interest_Rate = ($_POST['loan-years'] <= 3) ? $_POST['loan-amount'] * 0.1 * $_POST['loan-years'] : $_POST['loan-amount'] * 0.15 * $_POST['loan-years'];
    $TotalRepayment = $Interest_Rate + $_POST['loan-amount'];
    $RepaymentMonthly = $TotalRepayment / ($_POST['loan-years'] * 12);
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Bank</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <h1 class="text-center text-primary font-weight-bold mb-3">Bank</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="">Username</label>
        <input type="text" name="user-name" id="user-name" class="form-control" placeholder="" value="<?= $_SESSION['user-name'] ?? "" ?>" aria-describedby="helpId">
        <?= $errors['user-name'] ?? "" ?>
      </div>
      <div class="form-group">
        <label for="">Loan amount</label>
        <input type="number" name="loan-amount" id="loan-amount" class="form-control" placeholder="" value="<?= $_SESSION['loan-amount'] ?? "" ?>" aria-describedby="helpId" min="1">
        <?= $errors['loan-amount'] ?? "" ?>
      </div>
      <div class="form-group">
        <label for="">Loan Years</label>
        <input type="number" name="loan-years" id="loan-years" class="form-control" placeholder="" value="<?= $_SESSION['loan-years'] ?? "" ?>" aria-describedby="helpId" min="1">
        <?= $errors['loan-years'] ?? "" ?>
      </div>
      <div class="form-group">
        <button class="btn btn-primary w-100 text-light text-center">Calculate</button>
      </div>
    </form>
    <?php
    if (empty($errors) && !empty($_POST)) { ?>
      <table class="table">
        <thead>
          <tr>
            <th>Username</th>
            <th>Interset rate</th>
            <th>Loan after rate</th>
            <th>Monthly</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= $_POST['user-name'] ?></td>
            <td><?= $Interest_Rate . " LE" ?></td>
            <td><?= $TotalRepayment . " LE" ?></td>
            <td><?= $RepaymentMonthly . " LE" ?></td>
          </tr>
        </tbody>
      </table>
    <?php
    }
    ?>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>