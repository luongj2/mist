<?php 
    $title = "Mist Store";
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div>
    <form action="search.php" method="post">
        <input type="text" name="search" placeholder="Search">
        
        <button name="submit"><i class="fa fa-search"></i></button>
        
        <select name="sort">
            <option value="none">Sort By</option>
            <option value="alphabetical">Alphabetical Order</option>
            <option value="date">Release Date</option>
        </select>
        
        <select name="filter">
            <option value="none">Filter By Genre</option>
            <option value="casual">Casual</option>
            <option value="fps">FPS</option>
            <option value="rpg">RPG</option>
        </select>

        <?php
            if(isset($_SESSION["userID"])) {
                echo "<a href=\"../request/\">Request Game</a>";
            }
        ?>
    </form>

    <ul>
        <?php
            $search = getSearchQuery("search");
            $sort = getSearchQuery("sort");
            $filter = getSearchQuery("filter");

            $games = callProcedure("spGetGamesFromSearch", $search, $sort, $filter);

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

                echo "<a href=\"../game/index.php?id=$gameID\">";
                echo "<li>";
                echo "<img src = \"data:image/png;base64,$gamePicture\"><br>";
                echo "<h1>$gameName</h1><br>";
                echo "<h4>$gameDescription</h4><br>";
                echo "<p>Release Date: $gameDate</p>";
                echo "</li>";
                echo "<br>";
                echo "</a>\n";
            }
        ?>
    </ul>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>