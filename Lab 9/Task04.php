<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php
// Database connection
$host = 'localhost';
$dbname = 'newdb';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$itemsPerPage = 10;


$search = '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;


if (isset($_GET['search'])) {
    $search = $_GET['search'];

    
    $sql = "SELECT * FROM items WHERE name LIKE '%{$search}%' OR description LIKE '%{$search}%' LIMIT $offset, $itemsPerPage";
    $result = mysqli_query($conn, $sql);

    
    $sqlCount = "SELECT COUNT(*) as total FROM items WHERE name LIKE '%{$search}%' OR description LIKE '%{$search}%'";
    $resultCount = mysqli_query($conn, $sqlCount);
    $row = mysqli_fetch_assoc($resultCount);
    $totalItems = $row['total'];

   
    $totalPages = ceil($totalItems / $itemsPerPage);
}
?>

<h2>Search Items</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search...">
    <button type="submit">Search</button>
</form>

<?php if (isset($result)): ?>
    <h3>Search Results</h3>
    <p>Found <?php echo $totalItems; ?> item(s)</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
        <?php while ($item = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['description']; ?></td>
                <td><?php echo $item['price']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p>Pages:
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
    </p>
<?php endif; ?>

<?php

mysqli_close($conn);
?>
</body>
</html>
