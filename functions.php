<?php
    function buildSearchQuery(...$parameters) {
        $query = [];

        if(!empty($parameters[0])) {
            $query["search"] = $parameters[0];
        }
    
        if($parameters[1] != "none") {
            $query["sort"] = $parameters[1];
        }
    
        if($parameters[2] != "none") {
            $query["filter"] = $parameters[2];
        }

        return http_build_query($query);
    }

    function getSearchQuery($parameter) {
        if(isset($_GET[$parameter])) {
            return $_GET[$parameter];
        }

        return "";
    }

    function checkEmptyStrings(...$parameters) {
        foreach($parameters as $parameter) {
            if(empty($parameter)) {
                return true;
            }
        }

        return false;
    }

    function checkEmptyBooleans(...$parameters) {
        foreach($parameters as $parameter) {
            if($parameter == 1) {
                return false;
            }
        }

        return true;
    }

    function checkDifferentStrings(...$parameters) {
        return $parameters[0] != $parameters[1];
    }

    function checkInvalidEmailFormat($userEmail) {
        return !filter_var($userEmail, FILTER_VALIDATE_EMAIL);
    }

    function checkInvalidPasswordFormat($userPassword) {
        return strlen($userPassword) < 8 || preg_match('/\s/', $userPassword);
    }

    function checkLargePictureSize($picture) {
        $pictureDimensions = getimagesize($picture);
        $pictureWidth = $pictureDimensions[0];
        $pictureHeight = $pictureDimensions[1];

        if ($pictureWidth > 1200) {
            return true;
        }

        if ($pictureHeight > 600) {
            return true;
        }

        return false;
    }

    function getUserFromEmail($userEmail) {
        return callProcedure("spGetUserFromEmail", $userEmail)[0];
    }

    function checkPasswordMatchesEmail($userEmail, $userPassword) {
        $record = getUserFromEmail($userEmail);

        $databasePassword = $record["userPassword"];

        return !password_verify($userPassword, $databasePassword);
    }

    function loginUser($userEmail, $userPassword) {
        $userRecord = getUserFromEmail($userEmail);
        
        session_start();

        $_SESSION["userID"] = $userRecord["userID"];
    }
    
    function returnError($error) {
        header("location: index.php?error=".$error);
        exit();
    }
?>