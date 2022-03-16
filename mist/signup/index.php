<?php 
    $title = "Sign Up";
    include(dirname(__DIR__)."/includes/php/header.php");
?>

    <link rel="stylesheet" href="signup.css">    

    <div class="title">
        Sign Up
    </div>

    <form action="signup.php" method="post"> 
        <div class="form">
            <input type="text" name="userFirstName" placeholder="First Name">
            <input type="text" name="userLastName" placeholder="Last Name">
            <input type="text" name="userEmail" placeholder="Email">
            <input type="text" name="userEmailVerify" placeholder="Verify Email">
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
            echo "Please fill in all fields.";
            return;
        }

        if($_GET["error"] == "emailTaken") {
            echo "This email is taken. <a href=\"../login\">Log In?</button>";
            return;
        }

        if($_GET["error"] == "emailInvalid") {
            echo "Please enter a valid email address.";
            return;
        }

        if($_GET["error"] == "emailsDifferent") {
            echo "Please enter the same email address in both email address fields.";
            return;
        }

        if($_GET["error"] == "passwordInvalid") {
            echo "Please enter a valid password (minimum 8 characters).";
            return;
        }

        if($_GET["error"] == "passwordsDifferent") {
            echo "Please enter the same password in both password fields.";
            return;
        }

        if($_GET["error"] == "none") {
            echo "You are signed up! <a href=\"../login\">Log In?</button>";
            return;
        }

        echo "</p>";
    ?>
    
<?php include(dirname(__DIR__)."/includes/php/footer.php")?>