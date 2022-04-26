<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION["userID"])) {
        header("location: ../login");
        exit();
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $userID = $_SESSION["userID"];
        
    $user = callProcedure("spGetUserFromID", $userID)[0];
    
    $userName = $user["userName"];
    $userDate = $user["userDate"];
    $userRole = $user["userRole"];

    $title = $userName;
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <?php
        echo "<h1>$userName</h1>";
    ?>
</div>
    
<?php
    require(dirname(__DIR__, $steps)."/footer/index.php");
?>