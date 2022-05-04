<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    if(!isset($_POST["submit"])) {
        header("location: ../search");
        exit();
    }

    $searchQuery = [
        "search" =>  $_POST["search"],
        "sort" =>  $_POST["sort"],
        "filter" =>  $_POST["filter"]
    ];

    $searchQuery = formatSearchQuery($searchQuery);

    if(!empty($searchQuery)) {
        header("location: index.php?".$searchQuery);
    } else {
        header("location: ../search");
    }
    exit();
?>