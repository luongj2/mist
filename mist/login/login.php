<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];

    require "functions.php";
    require "../includes/php/database.php";

    if(emptyInput($userEmail, $userPassword)) {
        header("location: index.php?error=emptyInput");
        exit();
    }

    if(emailInvalid($connection, $userEmail)) {
        header("location: index.php?error=emailInvalid");
        exit();
    }

    if(passwordInvalid($connection, $userEmail, $userPassword)) {
        header("location: index.php?error=passwordInvalid");
        exit();
    }

    loginUser($connection, $userEmail, $userPassword);

    header("location: ../main");
    exit();
?>