<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

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

    if(checkEmptyStrings($userFirstName, $userLastName, $userEmail, $userPassword)) {
        returnError("emptyFields");
    }

    if(getUserFromEmail($userEmail)) {
        returnError("emailTaken");
    }

    if(checkInvalidEmailFormat($userEmail)) {
        returnError("invalidEmailFormat");
    }

    if(checkInvalidPasswordFormat($userPassword)) {
        returnError("invalidPasswordFormat");
    }

    if(checkDifferentStrings($userEmail, $userEmailVerify)) {
        returnError("differentEmails");
    }

    if(checkDifferentStrings($userPassword, $userPasswordVerify)) {
        returnError("differentPasswords");
    }

    $userPasswordHash = password_hash($userPassword, PASSWORD_DEFAULT);

    callProcedure("spSignupUser", $userFirstName, $userLastName, $userEmail, $userPasswordHash);

    returnError("none");
?>