<?php
    if(!isset($_GET["id"])) {
        header("Location: ../store");
        return;
    }

    $id = $_GET["id"];

    require "functions.php";

    $data = getData($id);
?>

<?php 
    $title = $data -> gameName;
    $steps = 1;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

    <?php     
        echo "<div class=\"content\">";
            echo "<h1 class=\"title\">" . $data -> gameName . "</h1>";
            echo "<div class=\"container\">";
                echo '<img src = "data:image/png;base64,' . base64_encode($data -> thumbnail) . '" width = "100px" height = "1090px"/>';
                echo "<div class=\"info\">";
                    echo "<h3>" . $data -> gameDescription . "</h3>";
                    echo "<br />";
                    echo "<h3> Developer: " . $data -> companyID . "</h3>";
                    echo "<br />";
                    echo "<h3> Release Date: " . $data -> gameReleaseDate . "</h3>";
                echo "</div>";
            echo "</div>";
        echo "</div>";        
    ?>

<?php include(dirname(__DIR__, $steps)."/footer/index.php")?>

