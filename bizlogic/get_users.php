<?php

    require "database.php";
    require "token.php";
    header('Content-Type: application/json');
    $auth = getallheaders()['Authorization'];

    if (!verifyToken(explode(' ', $auth)[1])) {
        echo json_encode(["error"=> "Invalid token"]);
        exit();
    } 
    
    $query = "SELECT id, name, username, email FROM User";
    $result = $db->query($query);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($users, $row);
    }

    echo json_encode(["data" => $users]);
    exit();
?>