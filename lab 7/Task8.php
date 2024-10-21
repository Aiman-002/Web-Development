<?php
// Usage of all types of variables using Loops

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

//  Function demonstrating the working of operators

function operatorDemo($a, $b) {
    echo "<br><br>Operator Demo:<br>";
    echo "Addition: " . ($a + $b) . "<br>";
    echo "Subtraction: " . ($a - $b) . "<br>";
    echo "Multiplication: " . ($a * $b) . "<br>";
    echo "Division: " . ($a / $b) . "<br>";
    echo "Modulus: " . ($a % $b) . "<br>";
}

// Testing the function
operatorDemo(10, 3);

//  Program to find the factorial of a given number

function factorial($n) {
    if ($n < 0) {
        exit("<br><br>Error: Input cannot be negative.");
    }
    
    $factorial = 1;
    for ($i = 1; $i <= $n; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}

// Test the function
echo "<br><br>Factorial of 5: " . factorial(5);

//  Program to generate Fibonacci series and find the sum of numbers divisible by 3, 5, and 7

// Using for loop
$sum = 0;
$prev = 0;
$current = 1;

for ($i = 1; $i <= 1000; $i++) {
    $fib = $prev + $current;
    $prev = $current;
    $current = $fib;

    if ($fib <= 1000) {
        if ($fib % 3 == 0 || $fib % 5 == 0 || $fib % 7 == 0) {
            $sum += $fib;
        }
    } else {
        break;
    }
}

echo "<br><br>Fibonacci Series:<br>";
echo "Sum of Fibonacci numbers divisible by 3, 5, and 7: " . $sum;

//  Recursive function to search for an element in an array

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
echo "<br><br>Recursive Search:<br>";
if (recursiveSearch($arr, $searchElement)) {
    echo "$searchElement found in the array.";
} else {
    echo "$searchElement not found in the array.";
}

//  Program to find all roots of a Quadratic equation using switch case and if else statement

// Quadratic equation: ax^2 + bx + c = 0
$a = 1;
$b = -3;
$c = 2;

// Calculate discriminant
$discriminant = $b * $b - 4 * $a * $c;

if ($discriminant > 0) {
    $root1 = (-$b + sqrt($discriminant)) / (2 * $a);
    $root2 = (-$b - sqrt($discriminant)) / (2 * $a);
    echo "<br><br>Quadratic Equation Roots:<br>";
    echo "Roots are real and different: $root1 and $root2";
} elseif ($discriminant == 0) {
    $root = -$b / (2 * $a);
    echo "<br><br>Quadratic Equation Roots:<br>";
    echo "Roots are real and same: $root";
} else {
    $realPart = -$b / (2 * $a);
    $imaginaryPart = sqrt(abs($discriminant)) / (2 * $a);
    echo "<br><br>Quadratic Equation Roots:<br>";
    echo "Roots are complex: $realPart + i$imaginaryPart and $realPart - i$imaginaryPart";
}

//  Signup form in PHP demonstrating the usage of global variable GET and POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "<br><br>Signup Form Data:<br>";
    echo "Username: $username<br>";
    echo "Email: $email<br>";
    echo "Password: $password<br>";
}
?>
