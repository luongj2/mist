<?php
    if(!isset($_POST["submit"])) {
        header("location: index.php");
        exit();
    }

    $gameName = $_POST["gameName"];
    $companyID = $_POST["companyID"];
    $gameGenre = $_POST["gameGenre"];
    $gameReleaseDate = $_POST["gameReleaseDate"];
    $gameDescription = $_POST["gameDescription"];
    $compatibleWindows = isset($_POST["compatibleWindows"]) ? 1 : 0;
    $compatibleMacOS = isset($_POST["compatibleMacOS"]) ? 1 : 0;
    $compatibleLinux = isset($_POST["compatibleLinux"]) ? 1 : 0;
    $gameThumbnail = file_get_contents($_FILES["gameThumbnail"]["tmp_name"]);

    $query = "
        INSERT INTO games
        VALUES('',?,?,?,?,?,?,?,?,?)
    ";

    $statement = mysqli_stmt_init(require("../../database/database.php"));
    mysqli_stmt_prepare($statement, $query);
    mysqli_stmt_bind_param($statement, "issssiiis", $companyID, $gameName, $gameDescription, $gameGenre, $gameReleaseDate, $compatibleWindows, $compatibleMacOS, $compatibleLinux, $gameThumbnail);
    mysqli_stmt_execute($statement);

    header("location: index.php?request=success");
    exit();
?>