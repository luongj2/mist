<?php
    function getPostsFromSearch($search, $sort) {
        $connection = require("../../database/database.php");

        $query = "CALL spGetPostsFromSearch(?, ?)";

        $statement = $connection->prepare($query);

        $statement->execute([$search, $sort]);

        $table = $statement->get_result();

        $records = [];

        while($records[] = $table->fetch_assoc()) {
            continue;
        }

        array_pop($records);

        return $records;
    }

    function getPostFromID($postID) {
        $connection = require("../../database/database.php");

        $query = "CALL spGetPostFromID(?)";

        $statement = $connection->prepare($query);

        $statement->execute([$postID]);

        $table = $statement->get_result();

        $record = $table->fetch_assoc();

        return $record;
    }

    function getUserFromID($userID) {
        $connection = require("../../database/database.php");

        $query = "CALL spgetUserFromID(?)";

        $statement = $connection->prepare($query);

        $statement->execute([$userID]);

        $table = $statement->get_result();

        $record = $table->fetch_assoc();

        return $record;
    }

    function buildSearchQueries($search, $sort) {
        $parameters = [];
        
        if(!empty($search)) {
            $parameters["search"] = $search;
        }
    
        if($sort != "none") {
            $parameters["sort"] = $sort;
        }

        $query = http_build_query($parameters);
    
        return $query;
    }

    function getSearchQuery($parameter) {
        if(isset($_GET[$parameter])) {
            return $_GET[$parameter];
        }

        return "";
    }

    function checkEmptyStrings($array) {
        foreach($array as $element) {
            if(empty($element)) {
                return true;
            }
        }

        return false;
    }

    function createPost($userID, $postName, $postDescription) {
        $connection = require("../../database/database.php");

        $query = "CALL spCreatePost(?, ?, ?, ?)";

        $statement = $connection->prepare($query);

        $postDate = date("20y-m-d");

        $statement->execute([$userID, $postName, $postDescription, $postDate]);
    }

    function returnError($error) {
        header("location: index.php?error=".$error);
        exit();
    }
?>