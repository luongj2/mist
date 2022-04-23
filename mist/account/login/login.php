<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];

    if(checkEmptyStrings($userEmail, $userPassword)) {
        returnError("emptyFields");
    }

    if(!getUserFromEmail($userEmail)) {
        returnError("emailNonexistent");
    }

    if(checkPasswordMatchesEmail($userEmail, $userPassword)) {
        returnError("incorrectPassword");
    }

    loginUser($userEmail, $userPassword);

    returnError("none");
?>