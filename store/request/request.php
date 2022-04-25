<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");
    
    session_start();

    if(!isset($_POST["submit"])) {
        header("location: ../search");
        exit();
    }
    
    $userID = $_SESSION["userID"];

    $gameName = $_POST["gameName"];
    $gameDescription = $_POST["gameDescription"];
    $gameGenre = $_POST["gameGenre"];
    $compatibleWindows = isset($_POST["compatibleWindows"]) ? 1 : 0;
    $compatibleMacOS = isset($_POST["compatibleMacOS"]) ? 1 : 0;
    $compatibleLinux = isset($_POST["compatibleLinux"]) ? 1 : 0;
    $gamePicture = file_get_contents($_FILES["gamePicture"]["tmp_name"]);

    if(checkEmptyStrings($gameName, $gameDescription, $gameGenre)) {
        returnError("emptyFields");
    }

    if(checkEmptyBooleans($compatibleWindows, $compatibleMacOS, $compatibleLinux)) {
        returnError("emptyChecks");
    }

    if(checkEmptyPicture($gamePicture)) {
        returnError("emptyPicture");
    }

    if(checkLargePictureSize($gamePicture)) {
        returnError("largePicture");
    }

    callProcedure("spCreateGame", $userID, $gameName, $gameDescription, $gameGenre, $gamePicture, $compatibleWindows, $compatibleMacOS, $compatibleLinux);

    returnError("none");
?>