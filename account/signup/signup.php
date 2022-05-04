<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    if(!isset($_POST["submit"])) {
        header("location: ../signup");
        exit();
    }
    
    $userFirstName = $_POST["userFirstName"];
    $userLastName = $_POST["userLastName"];
    $userEmail = $_POST["userEmail"];
    $userEmailVerify = $_POST["userEmailVerify"];
    $userPassword = $_POST["userPassword"];
    $userPasswordVerify = $_POST["userPasswordVerify"];

    if(checkEmptyStrings($userFirstName, $userLastName, $userEmail, $userPassword)) {
        returnError("emptyFields");
    }

    if(checkLargeString($userFirstName, 16)) {
        returnError("largeFirstName");
    }

    if(checkLargeString($userLastName, 16)) {
        returnError("largeLastName");
    }

    if(checkLargeString($userEmail, 64)) {
        returnError("largeEmail");
    }

    if(getUserFromEmail($userEmail)) {
        returnError("emailTaken");
    }

    if(checkInvalidEmail($userEmail)) {
        returnError("invalidEmailFormat");
    }

    if(checkInvalidPassword($userPassword)) {
        returnError("invalidPasswordFormat");
    }

    if(checkDifferentStrings($userEmail, $userEmailVerify)) {
        returnError("differentEmails");
    }

    if(checkDifferentStrings($userPassword, $userPasswordVerify)) {
        returnError("differentPasswords");
    }

    $userPasswordHash = password_hash($userPassword, PASSWORD_DEFAULT);

    callProcedure("spCreateUser", $userFirstName, $userLastName, $userEmail, $userPasswordHash);

    returnError("none");
?>