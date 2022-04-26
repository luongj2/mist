<?php
    if(!isset($_GET["id"])) {
        header("Location: ../store/search");
        return;
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $gameID = $_GET["id"];

    $game = callProcedure("spGetGameFromID", $gameID)[0];

    $gameName = $game["gameName"];
    $gameDescription = $game["gameDescription"];
    $gameGenre = $game["gameGenre"];
    $gameDate = $game["gameDate"];
    $gamePicture = base64_encode($game["gamePicture"]);
    $compatibleWindows = $game["compatibleWindows"];
    $compatibleMacOS = $game["compatibleMacOS"];
    $compatibleLinux = $game["compatibleLinux"];
    $developerName = $game["developerName"];

    $title = $gameName;
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <?php
        echo "<h1>$gameName</h1>";
        echo "<img src = \"data:image/png;base64,$gamePicture\">";
        echo "<h2>$gameDescription</h2><br>";
        echo "<h3>Developer: $developerName</h3><br>";
        echo "<h3>Release Date: $gameDate</h3>";     
    ?>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>