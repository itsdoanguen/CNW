<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        <?php
        
        echo "Hello, World!";
        $a = 5; $b = 10;
        echo "<br>";
        echo $a + $b;

        #Quotes inside strings
        $string = "12'inside quotes' 12 'inside quotes' 12";
        echo "<br>" . $string;

        # Concatenate different types to form a string
        $char_1 = 1; $char_2 = 2; $char_3 = '3';
        $char_res = "" . $char_1 . $char_2 . $char_3;
        echo "<br>" . $char_res;

        $string_example = "This is a string.";
        #uppercase a word inside a string
        $string_example = str_replace("string", "STRING", $string_example);
        echo "<br>" . $string_example;

        # Different ways to create arrays in PHP
        $traditional_array = array("apple", "banana", "cherry");
        echo "<br>" . $traditional_array[1]; // Outputs: banana

        $associative_array = array("first" => "apple", "second" => "banana", "third" => "cherry");
        echo "<br>" . $associative_array["second"]; // Outputs: banana
       
        #set null value to a variable
        $null_var = 3;
        $null_var = null;
        echo "<br>" . $null_var; // Outputs nothing
        $null_var = 5;
        unset($null_var); // Completely removes the variable
       
        #String connect
        $a = "Hello"; $b = "World";
        $a = $a." the ";
        echo "<br>" . $a.$b; // Outputs: Hello the World

        #catching exceptions
        $a = 10; $b = 0;
        // $catch_exception = @($a / $b); // Suppresses division by zero warning

        #switch case
        $day = 3;
        switch ($day) { 
            case 1:
                echo "<br>Monday";
                break;
            case 2:
                echo "<br>Tuesday";
                break;
            case 3:
                echo "<br>Wednesday";
                break;
            default:
                echo "<br>Another day";
        }

        #Traditional for loop
        echo "<br>For Loop:";
        for ($i = 0; $i < 5; $i++) {
            echo "<br>Iteration: " . $i;
        }
        #foreach loop for associative array
        echo "<br>Foreach Loop:";
        foreach ($associative_array as $key => $value) {
            echo "<br>" . $key . ": " . $value;
        }
        #foreach loop for traditional array
        echo "<br>Foreach Loop on Traditional Array:";
        foreach ($traditional_array as $value) {
            echo "<br>" . $value;
        }
        echo "<br>----------------------------------------------------------------<br>";
        #exp1
        $a = array('a' => 1, 'b' => 2, 'c' => 3);
        foreach ($a as $key => $value) {
            echo $key . "=" . $value;
            if ($key !== array_key_last($a)) {
                echo ",";
            }
        }
        echo "<br>----------------------------------------------------------------<br>";
       ?>
    </h1>
</body>
</html>