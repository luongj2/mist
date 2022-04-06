<?php 
    $title = "Mist Store";
    $steps = 1;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<form action="store.php" method="post">
    <div>
        <input type="text" name="search" placeholder="Search">

        <select name="cars" id="cars">
            <option>Sort By</option>
            <option value="date">Alphabetical Order</option>
            <option value="alphabetical">Release Date</option>
        </select>
        
        <select name="cars" id="cars">
            <option>Filter By Genre</option>
            <option value="casual">Casual</option>
            <option value="fps">FPS</option>
            <option value="rpg">RPG</option>
        </select>

        <button name="submit">Search</button>
    </div>

    <ul>
        <?php
            if(!isset($_GET["result"])) {
                return;
            }
            
            $results = explode(",", $_GET["result"], -1);

            require "functions.php";

            foreach($results as &$result) {
                $data = getData($result);
                echo "<li><a href=\"../games/index.php?id=$result\"><img src = \"data:image/png;base64," . base64_encode($data -> gameThumbnail) . "\"/></li>\n";
            }
        ?>
    </ul>
</form>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>