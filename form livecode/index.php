<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" name="form1">
        <input type="text" name="name" id="">
        <input type="submit">
    </form>


    <?php
    echo "<h1>";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') # check if form is submitted
        if (isset($_POST)) # check if form is submitted
            // if (isset($_POST['name'])) # check if form is submitted
            echo $_POST["name"];
    echo "</h1>";
    ?>

    <?php
    //echo "HI";
    // single line comment
    # single line comment
    /* multiline comment */

    $fname = 'Aya';
    $lname = 'mohammad';
    $number1 = 0;
    $number2 = 2;
    //$result = $num;

    //echo $number1 + $number2;

    //echo $fname.' '.$lname;

    $array = ['1', '2', '3']; //indexed array
    $arraym = [[1, 2], [3, 4]]; //multi diminsional array
    $arraya = [['name' => 'Abdallah', 'age' => '40'], ['name' => 'Sanad', 'age' => '50']]; // ass. array

    $testarray = [1, ['name' => 'aya'], 'string'];

    echo $testarray[2];

    for ($i = 0; $i < count($arraya); $i++) {
        echo $arraya[$i]['name'];
    }


    function name($arraya)
    {
        foreach ($arraya as $key => $element) {
            if ($element['name'] == 'Sanad') {
                echo $element['name'];
            }
        }
    }

    name($arraya);
    ?>
</body>

</html>