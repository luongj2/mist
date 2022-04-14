<?php
    $server = "mysql.fsb.miamioh.edu";
    $username = "luongj2";
    $password = "E^Fpm3^^oqrX";
    $name = "luongj2";

    $connection = mysqli_connect($server, $username, $password, $name);

    if(!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    return $connection;
?>