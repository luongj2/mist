<?php
    $steps = 1;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $title = "Welcome to Mist";
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<h1>
    Welcome To Mist.
<h1>
    
<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>