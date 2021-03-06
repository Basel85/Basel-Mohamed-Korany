<?php
   if($_POST){
     if($_POST['operator']=="+"){
        $result=$_POST['First_Number'] + $_POST['Second_Number'];
     }elseif($_POST['operator']=="-"){
        $result=$_POST['First_Number'] - $_POST['Second_Number'];
     }elseif($_POST['operator']=="*"){
        $result=$_POST['First_Number'] * $_POST['Second_Number'];
     }elseif($_POST['operator']=="/"){
        if($_POST['Second_Number']==0){
            $result="We can't divide by zero";
        }else{
            $result=$_POST['First_Number'] / $_POST['Second_Number'];
        }
     }elseif($_POST['operator']=="%"){
        if($_POST['Second_Number']==0){
            $result="We can't divide by zero";
        }else{
            $result=$_POST['First_Number'] % $_POST['Second_Number'];
            if($_POST['First_Number']<0 && $_POST['Second_Number']>0){
                $result+=$_POST['Second_Number'];
            }
        }
     }else{
        $result=$_POST['First_Number'] ** $_POST['Second_Number'];
     }
   }

?>

<!doctype html>
<html lang="en">
  <head>
    <title>calculator page</title>
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
                Calculator
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
                        <label for="operator">Operator</label>
                        <select name="operator" class="form-control" id="operator">
                            <option value="+">+</option>
                            <option value="-">-</option>
                            <option value="*">*</option>
                            <option value="/">/</option>
                            <option value="**">**</option>
                            <option value="%">%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-danger btn-sm">Calculate</button>
                    </div>
                </form>
                <div class="alert alert-success"> The result is <?php echo $result ?? ""; ?></div>
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