<?php
function factorial($n)
{
    if ($n < 0) {
        exit ("Input cannot be negative.");
    }

    $factorial = 1;
    for ($i = 1; $i <= $n; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}

// Test the function
echo "Factorial of 5: " . factorial(5) . "<br>";
?>