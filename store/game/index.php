<?php
    if(!isset($_GET["id"])) {
        header("Location: ../store/search");
        return;
    }

    require "../functions.php";

    $gameID = $_GET["id"];
    $game = getGameFromID($gameID);

    $gameName = $game["gameName"];
    $gameDescription = $game["gameDescription"];
    $gameGenre = $game["gameGenre"];
    $gameReleaseDate = $game["gameReleaseDate"];
    $compatibleWindows = $game["compatibleWindows"];
    $compatibleMacOS = $game["compatibleMacOS"];
    $compatibleLinux = $game["compatibleLinux"];
    $gameThumbnail = base64_encode($game["gameThumbnail"]);

    $companyID = $game["companyID"];
    $userID = $game["userID"];

    if($companyID != NULL) {
        $company = getCompanyFromID($companyID);
        $developerName = $company["companyName"];
    } else {
        $user = getUserFromID($userID);
        $developerName = $user["userFirstName"]." ".$user["userLastName"];
    }

    $title = $gameName;
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<?php
    echo "<div>";
    echo "<h1>$gameName</h1>";
    echo "<img src = \"data:image/png;base64,$gameThumbnail\">";
    echo "<h2>$gameDescription</h2><br>";
    echo "<h3>Developer: $developerName</h3><br>";
    echo "<h3>Release Date: $gameReleaseDate</h3>";
    echo "</div>";        
?>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>