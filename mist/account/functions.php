<?php
    function getUserFromEmail($userEmail) {
        $connection = require("../../database/database.php");

        $query = "CALL spGetUserFromEmail(?)";

        $statement = $connection->prepare($query);

        $statement->execute([$userEmail]);

        $table = $statement->get_result();

        $record = $table->fetch_assoc();

        return $record;
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
        $record = getUserFromEmail($userEmail);

        $databasePassword = $record["userPassword"];

        return !password_verify($userPassword, $databasePassword);
    }

    function loginUser($userEmail, $userPassword) {
        $userRecord = getUserFromEmail($userEmail);
        
        session_start();

        $_SESSION["userID"] = $userRecord["userID"];
    }

    function signupUser($userFirstName, $userLastName, $userEmail, $userPassword) {
        $connection = require("../../database/database.php");

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