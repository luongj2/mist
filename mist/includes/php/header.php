<?php
    session_start();
?>

<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../includes/css/main.css">
    <link rel="icon" href="../includes/png/icon.png">

    <title><?php echo $title ?></title>
</head>

<body>
    <noscript>You need to enable JavaScript to access this page.</noscript>

    <link rel="stylesheet" href="../includes/css/header.css">

    <div class="header">
        <a href="../main"><img class="logo" src="../includes/png/logo.png"></a>

        <div class="menu">
            <a class="tab" href="../store">STORE</a>
            <a class="tab" href="../forum">FORUM</a>
            <a class="tab" href="../about">ABOUT</a>
        </div>

        <div class="account">
            <?php 
                if(isset($_SESSION["userEmail"])) {
                    echo "<a class=\"login\" href=\"../profile\"><button>Profile</button></a>
                    <a class=\"signup\" href=\"../logout\"><button>Log Out</button></a>";
                } else {
                    echo "<a class=\"login\" href=\"../login\"><button>Log In</button></a>
                    <a class=\"signup\" href=\"../signup\"><button>Sign Up</button></a>";
                }
            ?>
        </div>
    </div>