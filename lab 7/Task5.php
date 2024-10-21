<?php
function recursiveSearch($arr, $element, $index = 0) {
    if ($index >= count($arr)) {
        return false;
    }

    if ($arr[$index] === $element) {
        return true;
    }

    return recursiveSearch($arr, $element, $index + 1);
}

// Test the function
$arr = array(5, 4, 3, 2, 1, 6, 10, 9, 7, 8);
$searchElement = 7;
if (recursiveSearch($arr, $searchElement)) {
    echo "$searchElement found in the array.";
} else {
    echo "$searchElement not found in the array.";
}
?>
