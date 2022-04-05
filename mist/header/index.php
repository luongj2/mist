<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">

        <link rel="icon" href="<?php echo str_repeat("../", $steps) ?>header/icon.png">

        <title><?php echo $title ?></title>
    </head>

    <body>
        <noscript>You need to enable JavaScript to access this page.</noscript>

        <link rel="stylesheet" href="<?php echo str_repeat("../", $steps) ?>header/styles.css">

        <header>
                <?php 
                    function createLink($href, $text) {
                        global $steps;
                        echo "<a href=\"" . str_repeat("../", $steps) . "$href\">$text</a>\n";
                    }
                     
                    function createButton($class, $text) {
                        return "<button class=\"$class\">$text</button>\n";
                    }

                    echo "<nav>\n";
                    createLink("main", "<img src=\"" . str_repeat("../", $steps) . "header/logo.png\">");
                    createLink("store", "STORE");
                    createLink("forum", "FORUM");
                    createLink("about", "ABOUT");
                    echo "</nav>\n";

                    echo "<nav>\n";
                    if(isset($_SESSION["userEmail"])) {
                        createLink("profile", createButton("profile", "Profile"));
                        createLink("logout", createButton("logout", "Log Out"));
                    } else {
                        createLink("login", createButton("login", "Log In"));
                        createLink("signup", createButton("signup", "Sign Up"));
                    }
                    echo "</nav>\n";
                ?>
        </header>

        <link rel="stylesheet" href="styles.css">