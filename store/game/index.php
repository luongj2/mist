<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_GET["gameID"])) {
        header("Location: ../store/search");
        return;
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $gameID = $_GET["gameID"];

    $game = callProcedure("spGetGameFromID", $gameID)[0];

    $gameName = $game["gameName"];
    $developerName = $game["developerName"];
    $gameDescription = $game["gameDescription"];
    $gameGenre = $game["gameGenre"];
    $gameDate = $game["gameDate"];
    $gamePicture = base64_encode($game["gamePicture"]);
    $compatibleWindows = $game["compatibleWindows"];
    $compatibleMacOS = $game["compatibleMacOS"];
    $compatibleLinux = $game["compatibleLinux"];

    $requestID = $game["requestID"];

    if($requestID != NULL) {
        $request = callProcedure("spGetRequestFromID", $requestID)[0];

        $requestAction = $request["requestAction"];
        $requestReason = $request["requestReason"];
    }

    $title = $gameName;
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <?php
        echo "<b>Name:</b> $gameName<br>";
        echo "<b>Developer:</b> $developerName<br>";
        echo "<b>Description:</b> $gameDescription<br>";
        echo "<b>Genre:</b> $gameGenre<br>";
        echo "<b>Date:</b> $gameDate<br>";
        echo "<img src = \"data:image/png;base64,$gamePicture\"><br>";
        echo "<b>Windows:</b> $compatibleWindows<br>";
        echo "<b>MacOS:</b> $compatibleMacOS<br>";
        echo "<b>Linux:</b> $compatibleLinux<br>";

        if($requestID != NULL) {
            echo "<b>Request Action:</b> $requestAction<br>";
            echo "<b>Request Reason:</b> $requestReason <br>";
        }
    ?>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>