<?php

$host = "localhost";
$username = "username";
$password = "password";
$database = "crud_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$results_per_page = 5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($current_page - 1) * $results_per_page;


if (isset($_GET['search'])) {
    $search_query = $_GET['search'];

   
    $count_sql = "SELECT COUNT(*) AS count FROM users WHERE name LIKE '%$search_query%' OR email LIKE '%$search_query%'";
    $count_result = $conn->query($count_sql);
    $total_results = $count_result->fetch_assoc()['count'];

    
    $total_pages = ceil($total_results / $results_per_page);

    
    $sql = "SELECT * FROM users WHERE name LIKE '%$search_query%' OR email LIKE '%$search_query%' LIMIT $start_from, $results_per_page";
    $result = $conn->query($sql);

    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
</head>

<body>
    <h2>User Search</h2>
    <form action="" method="get">
        <input type="text" name="search" placeholder="Search by name or email">
        <button type="submit">Search</button>
    </form>

    <?php if (isset($users) && !empty($users)) : ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Pagination -->
        <?php if ($total_pages > 1) : ?>
            <div>
                <?php if ($current_page > 1) : ?>
                    <a href="?search=<?php echo $search_query; ?>&page=<?php echo ($current_page - 1); ?>">Previous</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <a href="?search=<?php echo $search_query; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if ($current_page < $total_pages) : ?>
                    <a href="?search=<?php echo $search_query; ?>&page=<?php echo ($current_page + 1); ?>">Next</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php elseif (isset($search_query)) : ?>
        <p>No results found for '<?php echo $search_query; ?>'</p>
    <?php endif; ?>
</body>

</html>
