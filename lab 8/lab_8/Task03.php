<?php
// Database connection
$host = "localhost";
$username = "username";
$password = "password";
$database = "crud_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Registration functionality
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple validation
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Check if email already exists
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($check_email);
        if ($result->num_rows == 0) {
            // Insert user data into database
            $insert_sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($insert_sql) === TRUE) {
                $message = "Registration successful!";
            } else {
                $error = "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        } else {
            $error = "Email already exists!";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>

<body>
    <h2>User Registration</h2>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Register" name="register">
    </form>
</body>

</html>
