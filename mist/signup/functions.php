<?php
    function emptyInput($userFirstName, $userLastName, $userEmail, $userPassword) {
        return (empty($userFirstName) || empty($userLastName) || empty($userEmail) || empty($userPassword));
    }

    function emailTaken($connection, $userEmail) {
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

        return mysqli_fetch_assoc($result);
    }

    function emailInvalid($userEmail) {
        return !filter_var($userEmail, FILTER_VALIDATE_EMAIL);
    }

    function emailsDifferent($userEmail, $userEmailVerify) {
        return ($userEmail != $userEmailVerify);
    }

    function passwordInvalid($userPassword) {
        return (strlen($userPassword) < 8 || preg_match('/\s/', $userPassword));
    }

    function passwordsDifferent($userPassword, $userPasswordVerify) {
        return ($userPassword != $userPasswordVerify);
    }

    function signupUser($connection, $userFirstName, $userLastName, $userEmail, $userPassword) {
        $query = "
            INSERT INTO users (
                userFirstName, userLastName, userEmail, userPassword, userJoinDate
            )
            VALUES (
                ?, ?, ?, ?, ?
            )
        ";

        $statement = mysqli_stmt_init($connection);
        mysqli_stmt_prepare($statement, $query);

        $userPasswordHash = password_hash($userPassword, PASSWORD_DEFAULT);

        $userJoinDate = date("20y-m-d");

        mysqli_stmt_bind_param($statement, "sssss", $userFirstName, $userLastName, $userEmail, $userPasswordHash, $userJoinDate);

        mysqli_stmt_execute($statement);

        mysqli_stmt_close($statement);
    }
?>