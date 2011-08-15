<?php
    if (isset($_GET['sensor1']) && isset($_GET['sensor2'])) {
        # get timestamp
        $date = date('Y-m-d H:i:s');
        
        try
        {
            # get temperatures from $_GET array
            $temp1 = $_GET['sensor1'];
            $temp2 = $_GET['sensor2'];
        }
        catch (Exception $e)
        {
            echo $e->getMessage() . "<br />";
        }

        echo "<pre>"; 
        echo $date . "\n\n";
        echo "Beer side temperature: $temp1 &deg;C\n\n";
        echo "Ice side temperature: $temp2 &deg;C\n\n";
        echo "</pre>";

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
    }
    elseif (!isset($_GET['sensor1']) && !isset($_GET['sensor2'])) {
        # display last record instead
        $fp = fopen("history.txt", 'rb');

        if ($fp) {
            $line = '';
            $cursor = -1;
            fseek($fp, $cursor, SEEK_END);
            $char = fgetc($fp);

            # trim trailing newline characters of the file
            while ($char === "\n" || $char === "\r") {
                fseek($fp, $cursor--, SEEK_END);
                $char = fgetc($fp);
            }

            # read until the start of file or first newline character
            while ($char !== false && $char !== "\n" && $char !== "\r") {
                $line = $char . $line;
                fseek($fp, $cursor--, SEEK_END);
                $char = fgetc($fp);
            }

            echo "<pre>";
            echo "Last Temperature Record\n";
            echo "Time                  Beer T  Ice T\n";
            echo $line;
            echo "</pre>";
        }
    }
    elseif (!isset($_GET['sensor1'])) { 
        echo "<p>Cannot get temperature from beer side!</p>";
    }
    else {
        echo "<p>Cannot get temperature from ice side!</p>";
    }

    echo "<hr />";

    # output a history of temperatures
    echo "<pre>";
    echo "Temperature History\n";
    echo "Time                  Beer T  Ice T\n";

    # open file "history.txt" in 'rb' mode
    $fp = fopen("history.txt", 'rb');

    if ($fp) {
        while (!feof($fp)) {
            # read a line
            $record = fgets($fp, 999);
            echo $record;
        }
        # close file
        fclose($fp);
    }

    echo "</pre>";
?>
