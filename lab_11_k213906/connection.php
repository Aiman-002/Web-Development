<?php

$conn = new mysqli("localhost","root","","user");

if(!$conn){
    $response = array("error"=>"fail to connect","database"=>"user");
    echo json_encode($response);
}

?>
