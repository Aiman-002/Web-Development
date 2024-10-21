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

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch user's information from the database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found";
    exit();
}

// Update profile details
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update_sql = "UPDATE users SET name='$name', email='$email' WHERE username='$username'";
    $conn->query($update_sql);

    // Update session variable
    $_SESSION['name'] = $name;
}

// Upload new profile picture
if (isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $update_sql = "UPDATE users SET profile_picture='$target_file' WHERE username='$username'";
            $conn->query($update_sql);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>

<body>
    <h2>User Profile</h2>
    <img src="<?php echo isset($user['profile_picture']) ? $user['profile_picture'] : 'random_profile.jpg'; ?>" alt="Profile Picture" width="100">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="profile_picture">Upload New Profile Picture:</label><br>
        <input type="file" id="profile_picture" name="profile_picture"><br><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br><br>
        <input type="submit" value="Update" name="update">
    </form>
</body>

</html>
