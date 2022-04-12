<?php
    session_start();

    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $search = $_POST["search"];

    require "functions.php";
    
    $_SESSION['results'] = search($search);
    header("location: index.php");
    
    exit();
?>