<?php
    $db = new mysqli("localhost", "root", "root", "omobio");

    if ($db->connect_errno) {
        echo "DB Connection error: ".$db->connect_error;
        exit();
    }
?>