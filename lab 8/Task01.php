<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login Form </h1>
    <form action="Task01.php" method="post"> 
      <label>Name<lable>
      <input type="text" name="name" placeholder="Name" required>

      <label>Email<lable>
      <input type="text" name="email" placeholder="Email" required>

      <label>password<lable>
      <input type="password" name="password" placeholder="password" required>

      <input type="submit" name="submit">
    </form>
</body>
</html>

<?php

$server = "localhost";
$username = 'root';
$password = 'root';
$databaseName = 'Lab_8';
$conn = '';

$conn = new mysqli($server, $username, $password, $databaseName);

if($conn -> connect_error){
    die('connection failed'. $conn -> connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
}

$sql = "INSERT INTO user ( name, email, password ) VALUES ($name, $email, $password)" ;






?>