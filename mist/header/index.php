<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function createLink($href, $text) {
        global $steps;
        echo "<a href=\"".str_repeat("../", $steps)."$href\">$text</a>";
    }
        
    function createButton($class, $text) {
        return "<button class=\"$class\">$text</button>";
    }
?>

<html>
    <head>
        <meta charset="utf-8">

        <link rel="icon" href="<?php echo str_repeat("../", $steps) ?>images/misticon.png">

        <title><?php echo $title ?></title>
    </head>

    <body>
        <noscript>You need to enable JavaScript to access this page.</noscript>

        <link rel="stylesheet" href="<?php echo str_repeat("../", $steps) ?>header/styles.css">

        <header>
            <nav>
                <?php
                    createLink("main", "<img src=\"".str_repeat("../", $steps)."images/mistlogo.png\">");
                    createLink("store/search", "STORE");
                    createLink("forum/search", "FORUM");
                    createLink("about", "ABOUT");
                ?>
            </nav>

            <nav>
                <?php
                    if(isset($_SESSION["userID"])) {
                        $userID = $_SESSION["userID"];
                        createLink("account/profile/?userID=$userID", createButton("profile", "Profile"));
                        createLink("account/logout", createButton("logout", "Log Out"));
                    } else {
                        createLink("account/login", createButton("login", "Log In"));
                        createLink("account/signup", createButton("signup", "Sign Up"));
                    }
                ?>
            </nav>
        </header>

        <link rel="stylesheet" href="styles.css">