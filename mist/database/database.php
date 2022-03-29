<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $name = "mist";

    $connection = mysqli_connect($server, $username, $password, $name);

    if(!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    return $connection;
?>