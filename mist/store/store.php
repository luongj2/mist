<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $search = $_POST["search"];

    require "functions.php";
    
    header("location: index.php?result=" . search($search));
    exit();
?>