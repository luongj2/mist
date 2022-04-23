<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database/database.php");

    if(!isset($_GET["id"])) {
        header("Location: ../store/search");
        return;
    }

    $gameID = $_GET["id"];
    $game = callProcedure("spGetGameFromID", $gameID)[0];

    $title = $game["gameName"];
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<?php
    $gameName = $game["gameName"];
    $gameDescription = $game["gameDescription"];
    $gameGenre = $game["gameGenre"];
    $gameDate = $game["gameDate"];
    $compatibleWindows = $game["compatibleWindows"];
    $compatibleMacOS = $game["compatibleMacOS"];
    $compatibleLinux = $game["compatibleLinux"];
    $gameThumbnail = base64_encode($game["gameThumbnail"]);

    $companyID = $game["companyID"];
    $userID = $game["userID"];

    if($companyID != NULL) {
        $company = callProcedure("spGetCompanyFromID", $companyID)[0];
        $developerName = $company["companyName"];
    } else {
        $user = callProcedure("spGetUserFromID", $userID)[0];
        $developerName = $user["userFirstName"]." ".$user["userLastName"];
    }

    echo "<div>";
    echo "<h1>$gameName</h1>";
    echo "<img src = \"data:image/png;base64,$gameThumbnail\">";
    echo "<h2>$gameDescription</h2><br>";
    echo "<h3>Developer: $developerName</h3><br>";
    echo "<h3>Release Date: $gameDate</h3>";
    echo "</div>";        
?>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>