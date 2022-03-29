<?php 
    $title = "Mist Store";
    $steps = 1;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<form action="store.php" method="post">
    <div>
        <input type="text" name="search" placeholder="Search">

        <button name="submit">Search</button>
    </div>

    <ul>
        <?php
            if(!isset($_GET["result"])) {
                return;
            }

            $results = explode(",", $_GET["result"], -1);

            foreach($results as &$result) {
                echo "<li><a href=\"../games/$result\"><img src=\"../games/$result/thumbnail.png\"></a></li>\n";
            }
        ?>
    </ul>
</form>

<?php include(dirname(__DIR__, $steps)."/footer/index.php")?>