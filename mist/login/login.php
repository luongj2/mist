<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];

    require "functions.php";

    if(emptyInput($userEmail, $userPassword)) {
        header("location: index.php?error=emptyInput");
        exit();
    }

    if(emailInvalid($userEmail)) {
        header("location: index.php?error=emailInvalid");
        exit();
    }

    if(passwordInvalid($userEmail, $userPassword)) {
        header("location: index.php?error=passwordInvalid");
        exit();
    }

    loginUser($userEmail, $userPassword);

    header("location: ../main");
    exit();
?>