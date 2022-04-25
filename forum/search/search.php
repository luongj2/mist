<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $search = $_POST["search"];
    $sort = $_POST["sort"];
    
    $query = buildSearchQuery($search, $sort);

    if(!empty($query)) {
        header("location: index.php?".$query);
    } else {
        header("location: index.php");
    }

    exit();
?>