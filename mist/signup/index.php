<?php $title = "Sign Up" ?>
<?php include(dirname(__DIR__)."/includes/php/header.php")?>

    <link rel="stylesheet" href="signup.css">    

    <div class="title">
        Sign Up
    </div>

    <form action="signup.php" method="post"> 
        <div class="form">
            <input type="text" name="userFirstName" placeholder="First Name">
            <input type="text" name="userLastName" placeholder="Last Name">
            <input type="email" name="userEmail" placeholder="Email"
            <input type="email" name="userEmailVerify" placeholder="Verify Email">
            <input type="password" name="userPassword" placeholder="Password">
            <input type="password" name="userPasswordVerify" placeholder="Verify Password">
        </div>

        <div class="submit">
            <button name="submit">Sign Up</button>
        </div>
    </form>

    <?php
        if(!isset($_GET["error"])) {
            return;
        }

        echo "<p>";

        if($_GET["error"] == "emptyInput") {
            echo "Please fill in all fields!";
            return;
        }

        if($_GET["error"] == "emailTaken") {
            echo "Email is taken!";
            return;
        }

        if($_GET["error"] == "emailInvalid") {
            echo "Email Invalid!";
            return;
        }

        if($_GET["error"] == "emailsDifferent") {
            echo "Emails are not matching!";
            return;
        }

        if($_GET["error"] == "passwordInvalid") {
            echo "Make sure password is 8 characters or more!";
            return;
        }

        if($_GET["error"] == "passwordsDifferent") {
            echo "Passwords are not matching!";
            return;
        }

        if($_GET["error"] == "none") {
            echo "You are signed up!";
            return;
        }

        echo "</p>";
    ?>
    
<?php include(dirname(__DIR__)."/includes/php/footer.php")?>