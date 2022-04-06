<?php
    function getRecordFromEmail($userEmail) {
        $connection = require(dirname(__DIR__, 1)."/database/database.php");

        $query = "CALL spGetRecordFromEmail(?)";

        $statement = $connection->prepare($query);

        $statement->execute([$userEmail]);

        $result = $statement->get_result()->fetch_assoc();

        return $result;
    }

    function checkEmptyStrings($array) {
        foreach($array as $element) {
            if(empty($element)) {
                return true;
            }
        }

        return false;
    }

    function checkDifferentStrings($string1, $string2) {
        return $string1 != $string2;
    }

    function checkInvalidEmailFormat($userEmail) {
        return !filter_var($userEmail, FILTER_VALIDATE_EMAIL);
    }

    function checkInvalidPasswordFormat($userPassword) {
        return strlen($userPassword) < 8 || preg_match('/\s/', $userPassword);
    }

    function checkPasswordMatchesEmail($userEmail, $userPassword) {
        $record = getRecordFromEmail($userEmail);

        $databasePassword = $record["userPassword"];

        return !password_verify($userPassword, $databasePassword);
    }

    function loginUser($userEmail, $userPassword) {
        $userRecord = getRecordFromEmail($userEmail);
        
        session_start();

        $_SESSION["userEmail"] = $userRecord["userEmail"];
        $_SESSION["userFirstName"] = $userRecord["userFirstName"];
        $_SESSION["userlastName"] = $userRecord["userLastName"];
    }

    function signupUser($userFirstName, $userLastName, $userEmail, $userPassword) {
        $connection = require(dirname(__DIR__, 1)."/database/database.php");

        $query = "CALL spSignupUser(?, ?, ?, ?, ?)";

        $statement = $connection->prepare($query);

        $userPasswordHash = password_hash($userPassword, PASSWORD_DEFAULT);

        $userJoinDate = date("20y-m-d");

        $statement->execute([$userFirstName, $userLastName, $userEmail, $userPasswordHash, $userJoinDate]);
    }

    function returnError($error) {
        header("location: index.php?error=".$error);
        exit();
    }
?>