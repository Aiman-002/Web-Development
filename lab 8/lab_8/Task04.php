<?php
session_start();

// Database connection
$host = "localhost";
$username = "username";
$password = "password";
$database = "crud_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} elseif (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $username = $_COOKIE['username'];
} else {
    $username = null;
}

// Login functionality
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;

        // Set cookie to remember username
        setcookie('username', $username, time() + (86400 * 30), "/");

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php if ($username) : ?>
        <p>Welcome, <?php echo $username; ?>!</p>
        <a href="logout.php">Logout</a>
    <?php else : ?>
        <h2>Login</h2>
        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login" name="login">
        </form>
    <?php endif; ?>
</body>

</html>
