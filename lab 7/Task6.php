<?php
// Quadratic equation: ax^2 + bx + c = 0
$a = 1;
$b = -3;
$c = 2;

// Calculate discriminant
$discriminant = $b * $b - 4 * $a * $c;

if ($discriminant > 0) {
    $root1 = (-$b + sqrt($discriminant)) / (2 * $a);
    $root2 = (-$b - sqrt($discriminant)) / (2 * $a);
    echo "Roots are real and different: $root1 and $root2";
} elseif ($discriminant == 0) {
    $root = -$b / (2 * $a);
    echo "Roots are real and same: $root";
} else {
    $realPart = -$b / (2 * $a);
    $imaginaryPart = sqrt(abs($discriminant)) / (2 * $a);
    echo "Roots are complex: $realPart + i$imaginaryPart and $realPart - i$imaginaryPart";
}
?>
