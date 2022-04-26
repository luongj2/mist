<?php
    $title = "Pending Requests";
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");
    require(dirname(__DIR__, $steps)."/header/index.php");

    if(!isset($_SESSION["userID"]) || $_SESSION["userRole"] != "admin") {
        header("location: ../search");
        exit();
    }
?>

<div>
    <ul>
        <?php
            $games = callProcedure("spGetGamesFromSearch", "", "", "", "pending");

            foreach($games as $game) {
                $gameID = $game["gameID"];

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

                echo "<li>";
                echo "<img src = \"data:image/png;base64,$gamePicture\"><br>";
                echo "<h1>$gameName</h1><br>";
                echo "<h4>$gameDescription</h4><br>";
                echo "<p>Release Date: $gameDate</p>";
                echo "</li>";
                echo "<br>";
            }
        ?>
    </ul>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>