<?php
// Indexed array
$indexedArray = array("PHP", "HTML", "CSS", "JavaScript");

// Associative array
$assocArray = array("Name" => "John", "Age" => 25, "Country" => "USA");

// Multidimensional array
$multiArray = array(
    array("Apple", "Banana", "Mango"),
    array("Red", "Yellow", "Green"),
    array("Monday", "Tuesday", "Wednesday")
);

// Looping through indexed array
echo "Indexed Array:<br>";
foreach ($indexedArray as $value) {
    echo $value . "<br>";
}

// Looping through associative array
echo "<br>Associative Array:<br>";
foreach ($assocArray as $key => $value) {
    echo $key . ": " . $value . "<br>";
}

// Looping through multidimensional array
echo "<br>Multidimensional Array:<br>";
foreach ($multiArray as $innerArray) {
    foreach ($innerArray as $value) {
        echo $value . "<br>";
    }
}
?>
