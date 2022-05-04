<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $steps = 1;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $title = "About Mist";
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <h1>About Us</h1>

    <li>We serve to allow users to search and browse a variety of games in our game library through a web browser.</li>
    <li>Users can chat and create discussions through our online community forums.</li>
    <li>Publishers can also publish their own games alongside our expanding library.</li>

    <h2>Our Team</h2>

    <p>
        <u>Joey Luong</u><br>
        <i>Project Manager</i><br>
    </p>

    <p>
        <u>Harrison Baker</u><br>
        <i>Technical Manager</i><br>
    </p>

    <p>
        <u>Huy Nguyen</u><br>
        <i>Front-End Programmer</i><br>
    </p>

    <p>
        <u>Jon Kraft</u><br>
        <i>Back-End Programmer</i><br>
    </p>

    <p>
        <u>Eric Liao</u><br>
        <i>Back-End Programmer</i>
    </p>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>