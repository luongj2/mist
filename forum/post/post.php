<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $postID = $_GET["postID"];

    if(isset($_POST["delete"])) {
        callProcedure("spDeletePost", $postID);
    }
    
    if(isset($_POST["like"])) {
        callProcedure("spAddLike", $postID);
    }

    header("location: ../post/index.php?postID=$postID");
?>