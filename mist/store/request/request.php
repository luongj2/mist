<?php
    session_start();

    if(!isset($_POST["submit"])) {
        header("location: ../search/index.php");
        exit();
    }

    if(!isset($_SESSION["userID"])) {
        header("location: ../search/index.php");
        exit();
    }

    $userID = $_SESSION["userID"];

    $gameName = $_POST["gameName"];
    $gameDescription = $_POST["gameDescription"];
    $gameGenre = $_POST["gameGenre"];
    $compatibleWindows = isset($_POST["compatibleWindows"]) ? 1 : 0;
    $compatibleMacOS = isset($_POST["compatibleMacOS"]) ? 1 : 0;
    $compatibleLinux = isset($_POST["compatibleLinux"]) ? 1 : 0;

    require "../functions.php";

    if(checkEmptyStrings([$gameName, $gameDescription, $gameGenre])) {
        returnError("emptyFields");
    }

    if(checkEmptyBooleans([$compatibleWindows, $compatibleMacOS, $compatibleLinux])) {
        returnError("emptyChecks");
    }

    if(!isset($_POST["gameThumbnail"])) {
        returnError("emptyThumbnail");
    } else {
        $gameThumbnail = file_get_contents($_FILES["gameThumbnail"]["tmp_name"]);
    }

    createGame($userID, $gameName, $gameDescription, $gameGenre, $compatibleWindows, $compatibleMacOS, $compatibleLinux, $gameThumbnail);

    returnError("none");
?>