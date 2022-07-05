<?php

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender'=> 'm',
        ],
        'hobbies' => [
            'football', 'swimming','running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
    ],
    (object)[
        'id' => 2,
        'name' => 'Mohamed',
        "gender" => (object)[
            'gender'=> 'm',
        ],
        'hobbies' => [
            'swimming','running'
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender'=> 'f',
        ],
        'hobbies' => [
            'running'
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
            
        ],
    ],
];

?>

<!doctype html>
<html lang="en">

<head>
    <title>Dynamic-table page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="table-responsive">
        <table class="table table-bordered">
            <caption style="caption-side: top; text-align : center; font-size : 30px;">Dynamic Table</caption>
            <thead>
                <tr>
                    <?php
                    foreach ($users as $user) {
                        foreach ($user as $property => $value) {
                            echo "<th>{$property}</th>";
                        }
                        break;
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    $Row = "<tr>";
                    foreach ($user as $property => $value) {
                        if (is_array($value)) {
                            $array = $value;
                            $valuesOfArray = "";
                            foreach ($array as $_value) {
                                if (is_bool($_value)) {
                                    if ($_value == 1) {
                                        $valuesOfArray .= "TRUE<br>";
                                    } else {
                                        $valuesOfArray .= "FALSE<br>";
                                    }
                                } else {
                                    if($_value=='m' && $property=="gender"){
                                        $valuesOfArray .= "Male<br>";
                                        break;
                                    }elseif($_value=='f' && $property=="gender"){
                                        $valuesOfArray .= "Female<br>";
                                        break;
                                    }else{
                                        $valuesOfArray .= "{$_value}<br>";
                                    }
                                }
                            }
                            $Row .= "<td>{$valuesOfArray}</td>";
                        } elseif (is_object($value)) {
                            $object = $value;
                            $valuesOfObject = "";
                            foreach ($object as $_value) {
                                if (is_bool($_value)) {
                                    if ($_value == 1) {
                                        $valuesOfObject .= "TRUE<br>";
                                    } else {
                                        $valuesOfObject .= "FALSE<br>";
                                    }
                                } else {
                                    if($_value=='m' && $property=="gender"){
                                        $valuesOfObject .= "Male<br>";
                                        break;
                                    }elseif($_value=='f' && $property=="gender"){
                                        $valuesOfObject .= "Female<br>";
                                        break;
                                    }else{
                                        $valuesOfObject .= "{$_value}<br>";
                                    }
                                }
                            }
                            $Row .= "<td>{$valuesOfObject}</td>";
                        } else {
                            if (is_bool($value)) {
                                if ($value == 1) {
                                    $Row .= "<td>TRUE</td>";
                                } else {
                                    $Row .= "<td>FALSE</td>";
                                }
                            } else {
                                if($value=='m' && $property=="gender"){
                                    $Row .= "<td>Male</td>";
                                }elseif($value=='f' && $property=="gender"){
                                    $Row .= "<td>Female</td>";
                                }else{
                                    $Row .= "<td>{$value}</td>";
                                }
                            }
                        }
                    }
                    $Row .= "</tr>";
                    echo $Row;
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>