<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_info";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;

            // Set a cookie for the last visited page
            $lastVisitedPage = isset($_COOKIE['last_visited_page']) ? $_COOKIE['last_visited_page'] : 'dashboard.html';
            setcookie('last_visited_page', $lastVisitedPage, time() + (86400 * 30), "/"); // 30 days expiration

            header("Location: $lastVisitedPage");
            exit();
        } else {
            $error = "Invalid username or password. Please try again.";
        }
    } else {
        $error = "Invalid username or password. Please try again.";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
</body>
</html>
