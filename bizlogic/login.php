<?php
    require "database.php";
    require "token.php";
    
    header('Content-Type: application/json');

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT password FROM User WHERE username ='".$username."'";
    $result = $db->query($query);

    if ($result->num_rows == 0) {
        echo json_encode(['error' => 'Invalid login credentials']);
        exit();
    }

    while($row = mysqli_fetch_assoc($result)) {
        if ($password == $row['password']) {
            $token = generateToken($username);
            echo json_encode(['message' => 'Login success!', 'token' => $token]);
        } else {
            echo json_encode(['error' => 'Invalid login credentials']);
        }
    }
    exit();
?>