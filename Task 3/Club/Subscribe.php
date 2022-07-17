<?php
  session_start();
?>
<?php

   if($_SERVER["REQUEST_METHOD"]=="POST"){
      $errors=[];
      if(empty($_POST['subscriber-name']) && $_POST['subscriber-name']!="0"){
        $errors['subscriber-name']="<p class = 'text-danger'>The Member name is required</p>";
      }else{
        $_SESSION['subscriber-name']=$_POST['subscriber-name'];
      }
      if(empty($_POST['families'])){
        $errors['families']="<p class = 'text-danger'>The number of family members is required</p>";
      }else{
        $_SESSION['families']=$_POST['families'];
      }
      if(empty($errors)){
          $_SESSION['total-subscription']=($_POST['families']*2500)+10000;
          header("location:Games.php");
      }
   }

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Subscribtion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container w-50 mt-5">
        <h1 class="text-center text-primary font-weight-bold">Club</h1>
        <form action="" method="post">
             <div class="form-group">
               <label for="">Subscriber name</label>
               <input type="text" name="subscriber-name" id="subscriber-name" class="form-control" value="<?=$_SESSION['subscriber-name']??""?>" placeholder="" aria-describedby="helpId">
               <small id="helpId" class="text-muted">Club subscription starts with 10,000 LE</small>
               <?=$errors['subscriber-name']??""?>
             </div>
             <div class="form-group">
               <label for="">Number of family members</label>
               <input type="number" name="families" id="families" class="form-control" placeholder="" value="<?=$_SESSION['families']??""?>" aria-describedby="helpId" min="1">
               <small id="helpId" class="text-muted">Cost of each member is 2,500 LE</small>
               <?=$errors['families']??""?>
             </div>
             <div class="form-group">
                <button class="btn btn-primary text-center w-100">Subscribe</button>
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