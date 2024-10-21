<?php
// Using for loop
$sum = 0;
$prev = 0;
$current = 1;

for ($i = 1; $i <= 1000; $i++) {
    $fib = $prev + $current;
    $prev = $current;
    $current = $fib;

    if ($fib <= 1000) {
        echo $fib . " ";

        if ($fib % 3 == 0 || $fib % 5 == 0 || $fib % 7 == 0) {
            $sum += $fib;
        }
    } else {
        break;
    }
}

echo "<br>Sum of Fibonacci numbers divisible by 3, 5, and 7: " . $sum;
?>
