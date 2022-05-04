<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    if(!isset($_POST["submit"])) {
        header("location: ../search");
        exit();
    }

    $postID = $_GET["postID"];

    callProcedure("spDeletePost", $postID);

    header("location: ../search");
?>