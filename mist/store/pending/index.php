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

<form action="pending.php" method="post">
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
                $requestID = $game["requestID"];

                echo "<input style=\"display: none\" name=\"requestID\" value=$requestID>";
                echo "<li>";
                echo "<div class=\"aaa\">";
                    echo "<img src = \"data:image/png;base64,$gamePicture\"><br>";
                    echo "<h1>$gameName</h1><br>";
                    echo "<h4>$gameDescription</h4><br>";
                    echo "<p>Release Date: $gameDate</p>";
                echo "</div>";

                echo "<div>";
                    echo "<textarea style=\"display: block\"name=\"requestReason\" placeholder=\"Reason\" rows=\"8\"></textarea>";
                    echo "<br>";
                    echo "<button name=\"accept\">Accept</button>";
                    echo "<button name=\"deny\">Deny</button>";
                echo "</div>";
                echo "</li>";
                echo "<br>";
            }
        ?>
    </ul>
</form>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>