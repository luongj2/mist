<?php 
    $title = "Mist Store";
    $steps = 1;
    include(dirname(__DIR__, $steps)."/header/index.php");
    include_once "functions.php";
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="store">
    <form action="store.php" method="post">
        <div class="search-bar">
            <input type="text" name="search" placeholder="Search">
            <button name="submit"><i class="fa fa-search"></i></button>
            
            <div class="dropdown">
                <select name="sortby" id="sortby">
                    <option>Sort By</option>
                    <option value="date">Alphabetical Order</option>
                    <option value="alphabetical">Release Date</option>
                </select>
                
                <select name="filter" id="filter">
                    <option>Filter By Genre</option>
                    <option value="casual">Casual</option>
                    <option value="fps">FPS</option>
                    <option value="rpg">RPG</option>
                </select>
            </div>
        </div>

        <a href="./newgame/">Add Game</a>
    </form>

    <ul>
        <?php
            $results = explode(",", $_SESSION['results'], -1);

            foreach($results as &$result) {
                $data = getData($result);
                echo "<li><a href=\"../games/index.php?id=$result\"><img src = \"data:image/png;base64," . base64_encode($data -> gameThumbnail) . "\"/></li>\n";
            }
        ?>
    </ul>
</div>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>