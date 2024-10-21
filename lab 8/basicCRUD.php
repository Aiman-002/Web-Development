<?php
// Database connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CREATE operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// READ operation
$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}

// UPDATE operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// DELETE operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!-- HTML form for creating and updating records -->
<form method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>
    <input type="submit" name="submit" value="Create">
</form>

<!-- HTML form for updating records -->
<form method="post">
    <label for="id">ID of record to update:</label><br>
    <input type="number" id="id" name="id"><br>
    <label for="name">New name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="email">New email:</label><br>
    <input type="email" id="email" name="email"><br>
    <input type="submit" name="update" value="Update">
</form>

<!-- HTML form for deleting records -->
<form method="post">
    <label for="id">ID of record to delete:</label><br>
    <input type="number" id="id" name="id"><br>
    <input type="submit" name="delete" value="Delete">
</form>
