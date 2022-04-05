<?php
    function search($search) {
        $query = "
            SELECT
                *
            FROM
                games
        ";

        if(!empty($search)) {
            $query .= "
                WHERE
                    gameName = ?
            ";
        }

        $statement = mysqli_stmt_init(require("../database/database.php"));
        mysqli_stmt_prepare($statement, $query);

        if(!empty($search)) {
            mysqli_stmt_bind_param($statement, "s", $search);
        }

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        while($record = mysqli_fetch_assoc($result)){
            $ids .= $record["gameID"] . ",";
        }

        return $ids;
    }
?>