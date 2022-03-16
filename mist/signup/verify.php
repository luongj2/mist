<?php
    // Returns true if there is any empty input.
    function emptyInput($userFirstName, $userLastName, $userEmail, $userPassword) {
        return (empty($userFirstName) || empty($userLastName) || empty($userEmail) || empty($userPassword));
    }

    // Returns true if email is already registered in the database.
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

        if(!mysqli_stmt_prepare($statement, $query)) {
            return true;
        }

        mysqli_stmt_bind_param($statement, "s", $userEmail);

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result);

        mysqli_stmt_close($statement);
    }

    // Returns true if email does not contains '@' and '.com' or '.org'.
    function emailInvalid($userEmail) {
        return !filter_var($userEmail, FILTER_VALIDATE_EMAIL);
    }

    // Returns true if emails are different.
    function emailsDifferent($userEmail, $userEmailVerify) {
        return ($userEmail != $userEmailVerify);
    }

    // Returns true if password is less than 8 characters and contains ' '.
    function passwordInvalid($userPassword) {
        return (strlen($userPassword) < 8 || preg_match('/\s/', $userPassword));
    }

    // Returns true if passwords are different.
    function passwordsDifferent($userPassword, $userPasswordVerify) {
        return ($userPassword != $userPasswordVerify);
    }
?>