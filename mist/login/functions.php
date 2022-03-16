<?php
    function emptyInput($userEmail, $userPassword) {
        return (empty($userEmail) || empty($userPassword));
    }

    function getRecordFromEmail($connection, $userEmail) {
        $query = "
            SELECT
                *
            FROM
                users
            WHERE
                userEmail = ?;
        ";

        $statement = mysqli_stmt_init($connection);
        mysqli_stmt_prepare($statement, $query);

        mysqli_stmt_bind_param($statement, "s", $userEmail);

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $record = mysqli_fetch_assoc($result);

        return $record;
    }

    function emailInvalid($connection, $userEmail) {
        return !getRecordFromEmail($connection, $userEmail);
    }

    function passwordInvalid($connection, $userEmail, $userPassword) {
        $record = getRecordFromEmail($connection, $userEmail);

        $databasePassword = $record["userPassword"];

        return !password_verify($userPassword, $databasePassword);
    }

    function loginUser($connection, $userEmail, $userPassword) {
        $userRecord = getRecordFromEmail($connection, $userEmail);
        
        session_start();
        $_SESSION["userEmail"] = $userRecord["userEmail"];
        $_SESSION["userFirstName"] = $userRecord["userFirstName"];
        $_SESSION["userlastName"] = $userRecord["userLastName"];
    }
?>