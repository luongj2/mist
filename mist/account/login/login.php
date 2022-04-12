<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];

    require "../functions.php";

    if(checkEmptyStrings([$userEmail, $userPassword])) {
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