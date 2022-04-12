<?php
    session_start();

    if(!isset($_POST["submit"])) {
        header("location: ../search/index.php");
        exit();
    }

    if(!isset($_SESSION["userID"])) {
        header("location: ../search/index.php");
        exit();
    }

    $userID = $_SESSION["userID"];

    $postName = $_POST["postName"];
    $postDescription = $_POST["postDescription"];

    require "../functions.php";

    if(checkEmptyStrings([$postName, $postDescription])) {
        returnError("emptyFields");
    }

    createPost($userID, $postName, $postDescription);

    returnError("none");
?>