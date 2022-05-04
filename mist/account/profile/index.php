<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $userID = $_GET["userID"];
        
    $user = callProcedure("spGetUserFromID", $userID)[0];
    
    $userName = $user["userName"];
    $userDate = $user["userDate"];
    $userRole = ucfirst($user["userRole"]);

    $title = $userName;
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<section>
    <div>
        <?php
            echo "<img src=\"https://robohash.org/$userName?set=set4\">";
            echo "<h1>$userName [$userRole]</h1>";
        ?>
    </div>

    <div>
        <?php
            echo "<p>Date joined: $userDate</p>";
        ?>
    </div>
</section>
    
<?php
    require(dirname(__DIR__, $steps)."/footer/index.php");
?>