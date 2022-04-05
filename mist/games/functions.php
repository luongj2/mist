<?php
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
            $data -> thumbnail = $record["thumbnail"];
        }
        
        return $data;
    }
?>