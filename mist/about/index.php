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

    <div class="member-container">
        <div class="member">
            <div class="border">
                <img src="../images/profile/joey.jpg" />
            </div>
            <h3>Joey Luong</h3>
        </div>

        <div class="member">
            <div class="border">
                <img src="../images/profile/huy.jpg" />
            </div>
            <h3>Huy Nguyen</h3>
        </div>
        
        <div class="member">
            <div class="border">
                <img src="../images/profile/eric.jpg" />
            </div>
            <h3>Hongwei(Eric) Liao</h3>
        </div>
        
        <div class="member">
            <div class="border">
                <img src="../images/profile/harrison.jpg" />
            </div>
            <h3>Harrison Baker</h3>
        </div>
        
        <div class="member">
            <div class="border">
                <img src="../images/profile/jon.png" />
            </div>
            <h3>Jon Kraft</h3>
        </div>
    </div>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>