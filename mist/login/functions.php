<?php
    function getRecordFromEmail($userEmail) {
        $query = "
            SELECT
                *
            FROM
                users
            WHERE
                userEmail = ?;
        ";

        $statement = mysqli_stmt_init(require("../database/database.php"));
        mysqli_stmt_prepare($statement, $query);

        mysqli_stmt_bind_param($statement, "s", $userEmail);

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $record = mysqli_fetch_assoc($result);

        return $record;
    }

    function emptyInput($userEmail, $userPassword) {
        return (empty($userEmail) || empty($userPassword));
    }

    function emailInvalid($userEmail) {
        return !getRecordFromEmail($userEmail);
    }

    function passwordInvalid($userEmail, $userPassword) {
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
?>