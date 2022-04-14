<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $search = $_POST["search"];
    $sort = $_POST["sort"];

    require "../functions.php";

    $query = buildSearchQueries($search, $sort);

    if(!empty($query)) {
        header("location: index.php?".$query);
    } else {
        header("location: index.php");
    }

    exit();
?>