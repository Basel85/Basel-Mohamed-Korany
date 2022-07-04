<?php
   if($_POST){
      $maximum_number=$_POST['First_Number'];
      if($maximum_number<$_POST['Second_Number']){
        $maximum_number=$_POST['Second_Number'];
      }
      if($maximum_number<$_POST['Third_Number']){
        $maximum_number=$_POST['Third_Number'];
      }
      $minimum_number=$_POST['First_Number'];
      if($minimum_number>$_POST['Second_Number']){
        $minimum_number=$_POST['Second_Number'];
      }
      if($minimum_number>$_POST['Third_Number']){
        $minimum_number=$_POST['Third_Number'];
      }
   }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>maximum-minimum page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
        <div class="row">
            <div class="col-12 text-center text-danger h1 mt-5">
                Get the maximum and the minimum number
            </div>
            <div class="col-6 offset-3">
                <form action="" method="post">
                    <div class="form-group">
                      <label for="">First Number</label>
                      <input type="number" name="First_Number" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                    </div>
                    <div class="form-group">
                      <label for="">Second Number</label>
                      <input type="number" name="Second_Number" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                    </div>
                    <div class="form-group">
                      <label for="">Third Number</label>
                      <input type="number" name="Third_Number" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-danger btn-sm">Get</button>
                    </div>
                </form>
                <div class="alert alert-success"> The maximum number is <?php echo $maximum_number ?? ""; ?></div>
                <div class="alert alert-success"> The minimum number is <?php echo $minimum_number ?? ""; ?></div>
            </div>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>