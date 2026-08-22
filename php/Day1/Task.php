<?php

// ==========================================
// Question 1
echo "Welcome to php <br><br>";


// ==========================================
// Question 2

$x = 5;      
$y = 'Welcome '; 
$z = True;   


// ==========================================
// Question 3

echo "Type of \$x: " . gettype($x) . "<br>";
echo "Type of \$y: " . gettype($y) . "<br>";
echo "Type of \$z: " . gettype($z) . "<br><br>";


// ==========================================
// Question 4

echo "<strong>Method 1 (For Loop):</strong><br>";
for ($i = 0; $i <= 15; $i++) {
    echo $i . " ";
}
echo "<br>";

echo "<strong>Method 2 (While Loop):</strong><br>";
$j = 0;
while ($j <= 15) {
    echo $j . " ";
    $j++;
}
echo "<br><br>";


// ==========================================
// Question 5

define("INSTITUTE", "ITI");
// Alternatively using const keyword:
// const INSTITUTE = "ITI";
echo "Constant value: " . INSTITUTE . "<br><br>";


// ==========================================
// Question 6

echo "gettype(\$x): " . gettype($x) . "<br>";
echo "gettype(\$y): " . gettype($y) . "<br>";
echo "gettype(\$z): " . gettype($z) . "<br><br>";


// ==========================================
// Question 7

echo "isset(\$x): ";
var_dump(isset($x));
echo "<br>isset(\$y): ";
var_dump(isset($y));
echo "<br>isset(\$z): ";
var_dump(isset($z));
echo "<br><br>";


// ==========================================
// Question 8

echo "empty(\$x): ";
var_dump(empty($x));
echo "<br>empty(\$y): ";
var_dump(empty($y));
echo "<br>empty(\$z): ";
var_dump(empty($z));
echo "<br><br>";


// ==========================================
// Question 9
$m = 30;
$n = 25;
$result = $m + $n;

if ($result > 50) {
    echo "Accepted<br><br>";
} else {
    echo "Not accepted<br><br>";
}


// ==========================================
// Question 10

$salaries = [
    "Salary of Mr. A is" => "1000$",
    "Salary of Mr. B is" => "1200$",
    "Salary of Mr. C is" => "1400$"
];

echo "<table border='1' cellpadding='5' cellspacing='0'>";
foreach ($salaries as $description => $amount) {
    echo "<tr>";
    echo "<td>" . $description . "</td>";
    echo "<td>" . $amount . "</td>";
    echo "tr>";
}
echo "</table><br><br>";


