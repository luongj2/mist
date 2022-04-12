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

    $companyID = $game["companyID"];
    $company = getCompanyFromID($companyID);

    $companyName = $company["companyName"];
    $companyDescription = $company["companyDescription"];
    $companyLink = $company["companyLink"];

    $title = $gameName;
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<?php
    echo "<div class=\"content\">";
    echo "<h1 class=\"title\">$gameName</h1>";
    echo "<div class=\"container\">";
    echo "<img src = \"../images/thumbnails/$gameID.png\">";
    echo "<div class=\"info\">";
    echo "<h3>$gameDescription</h3>";
    echo "<br>";
    echo "<h3> Developer: $companyName</h3>";
    echo "<br>";
    echo "<h3> Release Date: $gameReleaseDate</h3>";
    echo "</div>";
    echo "</div>";
    echo "</div>";        
?>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>