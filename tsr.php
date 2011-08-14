<?php
    # get timestamp
    $date = date('Y-m-d H:i:s');
    
    # get temperatures from the form
    $temp1 = $_GET['sensor1'];
    $temp2 = $_GET['sensor2'];

    echo $date . '<br />';
    echo "<p>Current temperature detected by sensor 1: </p>";
    echo $temp1 . '<br />';
    echo "<p>Current temperature detected by sensor 2: </p>";
    echo $temp2 . '<br />';

    # format the output string
    $output_str = $date . "\t" . $temp1 . "\t" . $temp2 . "\n";

    # open file "history.txt" in 'ab' mode
    $fp = fopen("history.txt", 'ab');

    if ($fp) {
        # write output string to file
        fwrite($fp, $output_str);
        # close file
        fclose($fp);
    }

    echo "<p>Temperature History</p>";
    $fp = fopen("history.txt", 'rb');

    if ($fp) {
        while (!feof($fp)) {
            $record = fgets($fp, 999);
            echo $record . "<br />";
        }
        fclose($fp);
    }
?>
