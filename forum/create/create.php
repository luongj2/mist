<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_POST["submit"])) {
        header("location: ../search");
        exit();
    }

    $userID = $_SESSION["userID"];

    $postName = $_POST["postName"];
    $postDescription = $_POST["postDescription"];

    if(checkEmptyStrings([$postName, $postDescription])) {
        returnError("emptyFields");
    }

    if(checkLargeString($postName, 64)) {
        returnError("largeName");
    }

    if(checkLargeString($postDescription, 1028)) {
        returnError("largeDescription");
    }

    callProcedure("spCreatePost", $userID, $postName, $postDescription);

    returnError("none");
?>