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

    function getData($id) {
        $query = "
            SELECT
                *
            FROM
                games
        ";

        if(!empty($id)) {
            $query .= "
                WHERE
                    gameId = $id
            ";
        }

        $statement = mysqli_stmt_init(require("../database/database.php"));
        mysqli_stmt_prepare($statement, $query);

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);
        $num_row = mysqli_num_rows($result); 

        if ($num_row == 0) {
            header("Location: ../store");
            return;
        }

        $data = new class {};

        while($record = mysqli_fetch_assoc($result)){
            $data -> gameID = $record["gameID"];
            $data -> companyID = $record["companyID"];
            $data -> gameName = $record["gameName"];
            $data -> gameDescription = $record["gameDescription"];
            $data -> gameReleaseDate = $record["gameReleaseDate"];
            $data -> gameThumbnail = $record["gameThumbnail"];
        }
        
        return $data;
    }
?>