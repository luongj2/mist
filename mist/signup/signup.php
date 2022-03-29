<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $userFirstName = $_POST["userFirstName"];
    $userLastName = $_POST["userLastName"];
    $userEmail = $_POST["userEmail"];
    $userEmailVerify = $_POST["userEmailVerify"];
    $userPassword = $_POST["userPassword"];
    $userPasswordVerify = $_POST["userPasswordVerify"];

    require "functions.php";

    if(emptyInput($userFirstName, $userLastName, $userEmail, $userPassword)) {
        header("location: index.php?error=emptyInput");
        exit();
    }

    if(emailTaken($userEmail)) {
        header("location: index.php?error=emailTaken");
        exit();
    }

    if(emailInvalid($userEmail)) {
        header("location: index.php?error=emailInvalid");
        exit();
    }

    if(emailsDifferent($userEmail, $userEmailVerify)) {
        header("location: index.php?error=emailsDifferent");
        exit();
    }

    if(passwordInvalid($userPassword)) {
        header("location: index.php?error=passwordInvalid");
        exit();
    }

    if(passwordsDifferent($userPassword, $userPasswordVerify)) {
        header("location: index.php?error=passwordsDifferent");
        exit();
    }

    signupUser($userFirstName, $userLastName, $userEmail, $userPassword);

    header("location: index.php?error=none");
    exit();
?>