<?php
    $date = date('Y-m-d H:i:s');

    $temp1 = $_GET['sensor1'];
    $temp2 = $_GET['sensor2'];

    echo $date . '</br>';
    echo '<p>Temperature on sensor 1: </p>';
    echo $temp1 . '</br>';
    echo '<p>Temperature on sensor 2: </p>';
    echo $temp2 . '</br>';
?>
