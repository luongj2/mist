<?php 
    // Continues if the user pressed the submit button.
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    // Creates variables based on user input.
    $userFirstName = $_POST["userFirstName"];
    $userLastName = $_POST["userLastName"];
    $userEmail = $_POST["userEmail"];
    $userEmailVerify = $_POST["userEmailVerify"];
    $userPassword = $_POST["userPassword"];
    $userPasswordVerify = $_POST["userPasswordVerify"];

    // Calls the required files for verification and database creation.
    require "../includes/php/database.php";
    require "verify.php";

    // Checks if 
    if(empty($userFirstName)) {
        header("location: index.php?error=emptyInput");
        exit();
    }

    if(empty($userLastName)) {
        header("location: index.php?error=emptyInput");
        exit();
    }
    if(empty($userEmail)) {
        header("location: index.php?error=emptyInput");
        exit();
    }
    if(empty($userPassword)) {
        header("location: index.php?error=emptyInput");
        exit();
    }


    if(emailTaken($connection, $userEmail)) {
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

    $query = "
        INSERT INTO users (
            userFirstName, userLastName, userEmail, userPassword, userJoinDate
        )
        VALUES (
            ?, ?, ?, ?, ?
        )
    ";

    $statement = mysqli_stmt_init($connection);

    if(!mysqli_stmt_prepare($statement, $query)) {
        return true;
    }

    $userPasswordHash = password_hash($userPassword, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "sssss", $userFirstName, $userLastName, $userEmail, $userPasswordHash, $userJoinDate);

    mysqli_stmt_execute($statement);

    mysqli_stmt_close($statement);

    header("location: index.php?error=none");
    exit();
?>