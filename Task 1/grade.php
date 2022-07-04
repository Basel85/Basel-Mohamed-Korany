<?php
if ($_POST) {
    $Sum_of_grades = $_POST['physics'] + $_POST['chemistry'] + $_POST['biology'] + $_POST['mathematics'] + $_POST['computer'];
    $Sum_of_grades_percentage = ($Sum_of_grades / 500) * 100;
    $message = "You've got {$Sum_of_grades_percentage}% ";
    if ($Sum_of_grades_percentage >= 0 && $Sum_of_grades_percentage < 40){
        $message .= "and your grade is F";
    }
    elseif($Sum_of_grades_percentage >= 40 && $Sum_of_grades_percentage < 60){
        $message .= "and your grade is E";
    }
    elseif($Sum_of_grades_percentage >= 60 && $Sum_of_grades_percentage < 70){
        $message .= "and your grade is D";
    }elseif($Sum_of_grades_percentage >= 70 && $Sum_of_grades_percentage < 80){
        $message .= "and your grade is C";
    }
    elseif($Sum_of_grades_percentage >= 80 && $Sum_of_grades_percentage < 90){
        $message .= "and your grade is B";
    }elseif($Sum_of_grades_percentage >= 90){
        $message .= "and your grade is A";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Grade page</title>
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
                Get the grade of the student
            </div>
            <div class="col-6 offset-3">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Physics</label>
                        <input type="number" name="physics" id="" class="form-control" placeholder="" aria-describedby="helpId" required min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="">Chemistry</label>
                        <input type="number" name="chemistry" id="" class="form-control" placeholder="" aria-describedby="helpId" required min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="">Biology</label>
                        <input type="number" name="biology" id="" class="form-control" placeholder="" aria-describedby="helpId" required min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="">Mathematics</label>
                        <input type="number" name="mathematics" id="" class="form-control" placeholder="" aria-describedby="helpId" required min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="">Computer</label>
                        <input type="number" name="computer" id="" class="form-control" placeholder="" aria-describedby="helpId" required min="0" max="100">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-danger btn-sm">Get the final grade</button>
                    </div>
                </form>
                <div class="alert alert-success">
                    <p>The sum of grades is <?=$Sum_of_grades??""?></p>
                    <p><?=$message??""?></p>
                </div>
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