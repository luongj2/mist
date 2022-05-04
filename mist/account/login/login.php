<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    if(!isset($_POST["submit"])) {
        header("location: ../login");
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

    loginUser($userEmail);

    returnError("none");
?>