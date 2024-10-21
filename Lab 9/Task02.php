<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_info";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();


$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.html");
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
    }
} else {
    echo "Invalid username or password. Please try again.";
}

mysqli_close($conn);
?>

