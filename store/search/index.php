<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $title = "Mist Store";
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div>
    <form action="search.php" method="post">
        <input type="text" name="search" placeholder="Search">
        
        <button name="submit"><img src="../../images/searchicon.svg"></button>
        
        <select name="sort">
            <option value="none">Sort By</option>
            <option value="atoz">A-Z</option>
            <option value="ztoa">Z-A</option>
            <option value="oldest">Oldest</option>
            <option value="newest">Newest</option>
        </select>

        <select name="filter">
            <option value="none">Filter By</option>
            <option value="Casual">Casual</option>
            <option value="FPS">FPS</option>
            <option value="RPG">RPG</option>
        </select>

        <?php
            if(isset($_SESSION["userID"])) {
                echo "<a href=\"../request/\">Request Game</a>";

                if($_SESSION["userRole"] == "admin") {
                    echo "<a href=\"../pending/\">Pending Requests</a>";
                }
            }
        ?>
    </form>

    <ul>
        <?php
            $search = getSearchQuery("search");
            $sort = getSearchQuery("sort");
            $filter = getSearchQuery("filter");

            $games = callProcedure("spGetGamesFromSearch", $search, $sort, $filter, "accepted");

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

                echo "<a href=\"../game/index.php?gameID=$gameID\">";
                echo "<li>";
                echo "<b>Name:</b> $gameName<br>";
                echo "<b>Developer:</b> $developerName<br>";
                echo "<b>Description:</b> $gameDescription<br>";
                echo "<b>Genre:</b> $gameGenre<br>";
                echo "<b>Date:</b> $gameDate<br>";
                echo "<img src = \"data:image/png;base64,$gamePicture\"><br>";
                echo "</li><br>";
                echo "</a>\n";
            }
        ?>
    </ul>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>