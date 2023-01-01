<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $food1 = $_POST['food1'];
    $food2 = $_POST['food2'];
    $food3 = $_POST['food3'];

    
    // Append the form data to a local file
    $file = fopen('form_data.txt', 'a');
    fwrite($file, "$food1\n");
    fwrite($file, "$food2\n");
    fwrite($file, "$food3\n");
    fclose($file);

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="form_data.txt"');
    readfile('form_data.txt');
}

if (isset($_POST['sort'])) {
    // Open the file and read the contents into an array
    $file = fopen('form_data.txt', 'r');
    $foods = [];
    while (($line = fgets($file)) !== false) {
      list($label, $food) = explode(': ', $line);
      $foods[] = $food;
    }
    fclose($file);
  
    // Sort the array
    sort($foods);
  
    // Display the sorted list of foods
    echo "<h1>Sorted Foods:</h1>";
    foreach ($foods as $food) {
      echo "$food";
    }
  }


if (isset($_POST['check'])) {
    // Open the file and read the contents into an array
    $file = fopen('form_data.txt', 'r');
    $foods = [];
    while (($line = fgets($file)) !== false) {
        list($label, $food) = explode(': ', $line);
        $foods[] = $food;
    }
    fclose($file);

    // Check for duplicates
    $duplicates = array_diff_assoc($foods, array_unique($foods));

    // Display the result
    if (empty($duplicates)) {
        echo "<h1>No duplicates found</h1>";
    } else {
        echo "<h1>Duplicates found:</h1>";
        foreach ($duplicates as $food) {
            echo "$food";
        }
    }
}
