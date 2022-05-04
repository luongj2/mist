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
    $gamePicture = $_FILES["gamePicture"]["tmp_name"];
    $gamePictureBLOB = file_get_contents($gamePicture);

    if(checkEmptyStrings($gameName, $gameDescription, $gameGenre)) {
        returnError("emptyFields");
    }

    if(checkEmptyBooleans($compatibleWindows, $compatibleMacOS, $compatibleLinux)) {
        returnError("emptyChecks");
    }

    if(checkEmptyStrings($gamePictureBLOB)) {
        returnError("emptyPicture");
    }

    if(checkLargeString($gameName, 64)) {
        returnError("largeName");
    }

    if(checkLargeString($gameDescription, 1028)) {
        returnError("largeDescription");
    }

    if(checkLargeString($gameGenre, 16)) {
        returnError("largeGenre");
    }

    if(checkLargePicture($gamePicture)) {
        returnError("largePicture");
    }

    $gameID = callProcedure("spCreateRequest", $userID, $gameName, $gameDescription, $gameGenre, $gamePictureBLOB, $compatibleWindows, $compatibleMacOS, $compatibleLinux)[0]["gameID"];

    returnError("none&gameID=$gameID");
?>