
<?php
include 'db_connection.php';

$id = $_POST['id'];

$sql = "DELETE FROM doctors WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "Doctor deleted successfully!";
} else {
    echo "Error deleting doctor: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
