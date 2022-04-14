<?php 
    $title = "Mist Store";
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
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
            require "../functions.php";

            $search = getSearchQuery("search");
            $sort = getSearchQuery("sort");
            $filter = getSearchQuery("filter");

            $games = getGamesFromSearch($search, $sort, $filter);

            foreach($games as &$game) {
                $gameID = $game["gameID"];
                $companyID = $game["companyID"];
                $gameName = $game["gameName"];
                $gameDescription = $game["gameDescription"];
                $gameReleaseDate = $game["gameReleaseDate"];
                $gameThumbnail = base64_encode($game["gameThumbnail"]);

                echo "<a href=\"../game/index.php?id=$gameID\">";
                echo "<li>";
                echo "<img src = \"data:image/png;base64,$gameThumbnail\"><br>";
                echo "<h1>$gameName</h1><br>";
                echo "<h4>$gameDescription</h4><br>";
                echo "<p>Release Date: $gameReleaseDate</p>";
                echo "</li>";
                echo "<br>";
                echo "</a>\n";
            }
        ?>
    </ul>
</div>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>