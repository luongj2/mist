<?php
    function getGamesFromSearch($search, $sort, $filter) {
        $connection = require(dirname(__DIR__, 1)."/database/database.php");

        $query = "CALL spGetGamesFromSearch(?, ?, ?)";

        $statement = $connection->prepare($query);

        $statement->execute([$search, $sort, $filter]);

        $table = $statement->get_result();

        $records = [];

        while($records[] = $table->fetch_assoc()) {
            continue;
        }

        array_pop($records);

        return $records;
    }

    function getGameFromID($gameID) {
        $connection = require(dirname(__DIR__, 1)."/database/database.php");

        $query = "CALL spGetGameFromID(?)";

        $statement = $connection->prepare($query);

        $statement->execute([$gameID]);

        $table = $statement->get_result();

        $record = $table->fetch_assoc();

        return $record;
    }

    function getCompanyFromID($companyID) {
        $connection = require(dirname(__DIR__, 1)."/database/database.php");

        $query = "CALL spGetCompanyFromID(?)";

        $statement = $connection->prepare($query);

        $statement->execute([$companyID]);

        $table = $statement->get_result();

        $record = $table->fetch_assoc();

        return $record;
    }

    function getUserFromID($userID) {
        $connection = require(dirname(__DIR__, 1)."/database/database.php");

        $query = "CALL spGetUserFromID(?)";

        $statement = $connection->prepare($query);

        $statement->execute([$userID]);

        $table = $statement->get_result();

        $record = $table->fetch_assoc();

        return $record;
    }

    function buildSearchQueries($search, $sort, $filter) {
        $parameters = [];
        
        if(!empty($search)) {
            $parameters["search"] = $search;
        }
    
        if($sort != "none") {
            $parameters["sort"] = $sort;
        }
    
        if($filter != "none") {
            $parameters["filter"] = $filter;
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

    function checkEmptyBooleans($array) {
        foreach($array as $element) {
            if($element == 1) {
                return false;
            }
        }

        return true;
    }

    function createGame($userID, $gameName, $gameDescription, $gameGenre, $compatibleWindows, $compatibleMacOS, $compatibleLinux, $gameThumbnail) {
        $connection = require(dirname(__DIR__, 1)."/database/database.php");

        $query = "CALL spCreateGame(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $connection->prepare($query);

        $gameReleaseDate = date("20y-m-d");

        $statement->execute([$userID, $gameName, $gameDescription, $gameGenre, $gameReleaseDate, $compatibleWindows, $compatibleMacOS, $compatibleLinux, $gameThumbnail]);
    }

    function returnError($error) {
        header("location: index.php?error=".$error);
        exit();
    }
?>