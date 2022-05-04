<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_GET["gameID"])) {
        header("location: ../search");
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
    $compatibleWindows = ($game["compatibleWindows"] == 1) ? "<img src=\"../../images/os/windows.svg\">" : "";
    $compatibleMacOS = ($game["compatibleMacOS"] == 1) ? "<img src=\"../../images/os/macos.svg\">" : "";
    $compatibleLinux = ($game["compatibleLinux"] == 1) ? "<img src=\"../../images/os/linux.svg\">" : "";

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
        echo "
            <b>$gameName</b>
            <b>$developerName</b>
            <b>$gameDescription</b>
            <b>$gameGenre</b>
            <b>$gameDate</b>
            <img src = \"data:image/png;base64,$gamePicture\">
            <div class=\"icons\">$compatibleWindows $compatibleMacOS $compatibleLinux</div>
        ";

        if($requestID != NULL) {
            echo "<b>Request Action:</b> $requestAction<br>";
            echo "<b>Request Reason:</b> $requestReason <br>";
        }
    ?>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>