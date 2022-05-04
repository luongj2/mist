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

<div class="search">
    <form class="search-query" action="search.php" method="post">
        <div class="search-bar">
            <input type="text" name="search" placeholder="Search">
            <button name="submit"><img src="../../images/searchicon.svg"></button>
        </div>
        
        <div class="search-options">
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
        </div>

        <div class="game-requests">
            <?php
                if(isset($_SESSION["userID"])) {
                    echo "<a href=\"../request/\">Request Game</a>";

                    if($_SESSION["userRole"] == "admin") {
                        echo "<a href=\"../pending/\">Pending Requests</a>";
                    }
                }
            ?>
        </div>
    </form>

    <div class="game-list">
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
                $compatibleWindows = ($game["compatibleWindows"] == 1) ? "<img src=\"../../images/os/windows.svg\">" : "";
                $compatibleMacOS = ($game["compatibleMacOS"] == 1) ? "<img src=\"../../images/os/macos.svg\">" : "";
                $compatibleLinux = ($game["compatibleLinux"] == 1) ? "<img src=\"../../images/os/linux.svg\">" : "";

                echo "
                    <div class=\"game\">
                            <a class=\"game-info\" href=\"../game/index.php?gameID=$gameID\">
                                <h1>$gameName</h1>
                                <h2>$gameGenre $compatibleWindows $compatibleMacOS $compatibleLinux</h2>
                            </a>

                            <img class=\"game-picture\" src = \"data:image/png;base64,$gamePicture\">
                    </div>
                ";
            }
        ?>
    </div>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>