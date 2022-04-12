<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $search = $_POST["search"];
    $sort = $_POST["sort"];
    $filter = $_POST["filter"];

    require "../functions.php";

    $queries = buildSearchQueries($search, $sort, $filter);

    if(!empty($queries)) {
        header("location: index.php?".$queries);
    } else {
        header("location: index.php");
    }
    exit();
?>