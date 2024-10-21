<?php

$api_key = $_SERVER["HTTP_API_KEY"] ?? '';
$valid_api_key = "asdfghjk";

require_once "connection.php";
header('Content-type: application/json');


function sanitize($data)
{
    global $conn;
    return mysqli_real_escape_string($conn,$data);
}
if ($api_key != $valid_api_key) {
    echo $api_key;
    http_response_code(401);
    $response = array("error" => true, "status" => "api key not available");
    echo json_encode($response);
} else {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "login":
                $password = sanitize($_POST["password"]) ?? null;
                $email = sanitize($_POST["email"]) ?? null;
                
                if ($password && $email) {
                    $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password' ";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $response = array("error" => false, "status" => "user found");
                        $response['data'] = mysqli_fetch_assoc($result);
                        echo json_encode($response);
                    } else {
                        http_response_code(401);
                        $response = array("error" => true, "status" => "user not found");
                        echo json_encode($response);
                    }
                }
                break;
            case "create-user":
                $name = sanitize($_POST["name"]) ?? null;
                $password = sanitize($_POST["password"]) ?? null;
                $email = sanitize($_POST["email"]) ?? null;
                if ($name && $password && $email) {
                    $sql = "INSERT INTO user (name, password, email) VALUES ('$name', '$password', '$email')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $response = array("error" => false, "status" => "user added");
                        echo json_encode($response);
                    } else {
                        $response = array("error" => true, "status" => "failed to insert user");
                        echo json_encode($response);
                    }
                } else {
                    http_response_code(400);
                    $response = array("error" => true, "status" => "missing required fields");
                    echo json_encode($response);
                }
                break;
            case "update-user":
                $id = $_GET["id"] ?? null;
                $name = sanitize($_POST["name"]) ?? null;
                $password = sanitize($_POST["password"]) ?? null;
                $email = sanitize($_POST["email"]) ?? null;
                if ($id && $name && $password && $email) {
                    $sql = "UPDATE user SET name = '$name', email = '$email', password = '$password' WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $response = array("error" => false, "status" => "user updated");
                        echo json_encode($response);
                    } else {
                        $response = array("error" => true, "status" => "failed to update user");
                        echo json_encode($response);
                    }
                } else {
                    http_response_code(400);
                    $response = array("error" => true, "status" => "missing required fields");
                    echo json_encode($response);
                }
                break;
            case "delete-user":
                $id = $_GET["id"] ?? null;
                if ($id) {
                    $sql = "DELETE FROM user WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $response = array("error" => false, "status" => "user deleted");
                        echo json_encode($response);
                    } else {
                        $response = array("error" => true, "status" => "failed to delete user");
                        echo json_encode($response);
                    }
                } else {
                    http_response_code(400);
                    $response = array("error" => true, "status" => "missing required fields");
                    echo json_encode($response);
                }
                break;
            case "get-user":
                $sql = "SELECT * FROM user";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    $users = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $users[] = $row;
                    }
                    $response = array("error" => false, "status" => "users fetched", "data" => $users);
                    echo json_encode($response);
                } else {
                    http_response_code(404);
                    $response = array("error" => true, "status" => "no users found");
                    echo json_encode($response);
                }
                break;
            case "get-products":
                $sql = "SELECT * FROM product";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    $products = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $products[] = $row;
                    }
                    $response = array("error" => false, "status" => "products fetched", "data" => $products);
                    echo json_encode($response);
                } else {
                    http_response_code(404);
                    $response = array("error" => true, "status" => "no products found");
                    echo json_encode($response);
                }
                break;
            default:
                http_response_code(400);
                $response = array("error" => true, "status" => "invalid action");
                echo json_encode($response);
                break;
        }
    } else {
        http_response_code(400);
        $response = array("error" => true, "status" => "action parameter missing");
        echo json_encode($response);
    }
}
?>
