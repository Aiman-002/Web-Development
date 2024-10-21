
<?php
include 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$specialization = $_POST['specialization'];
$contact = $_POST['contact'];

$sql = "UPDATE doctors SET name='$name', specialization='$specialization', contact='$contact' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "Doctor updated successfully!";
} else {
    echo "Error updating doctor: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
