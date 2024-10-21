
<?php
include 'db_connection.php';

$name = $_POST['name'];
$specialization = $_POST['specialization'];
$contact = $_POST['contact'];

$sql = "INSERT INTO doctors (name, specialization, contact) VALUES ('$name', '$specialization', '$contact')";

if (mysqli_query($conn, $sql)) {
    echo "Doctor added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
