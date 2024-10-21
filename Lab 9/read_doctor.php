
<?php
include 'db_connection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM doctors WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    echo "<h2>Doctor Details</h2>";
    echo "<p>ID: " . $row["id"] . "</p>";
    echo "<p>Name: " . $row["name"] . "</p>";
    echo "<p>Specialization: " . $row["specialization"] . "</p>";
    echo "<p>Contact: " . $row["contact"] . "</p>";
} else {
    echo "Doctor not found!";
}

mysqli_close($conn);
?>
