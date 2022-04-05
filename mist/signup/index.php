<?php 
    $title = "Sign Up";
    $steps = 1;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<form action="signup.php" method="post">
    <h1>Sign Up</h1>

    <?php 
        function createInput($type, $name, $placeholder) {
            echo "<input type=\"$type\" name=\"$name\" placeholder=\"$placeholder\">";
        }

        createInput("text", "userFirstName", "First Name");
        createInput("text", "userLastName", "Last Name");
        createInput("text", "userEmail", "Email");
        createInput("text", "userEmailVerify", "Verify Email");
        createInput("password", "userPassword", "Password (8 characters minimum)");
        createInput("password", "userPasswordVerify", "Verify Password");
    ?>

    <button name="submit">Submit</button>

    <?php
        if(!isset($_GET["error"])) {
            return;
        }

        echo "<p>";
        
        if($_GET["error"] == "emptyInput") {
            echo "Please fill in all fields.";
        }

        if($_GET["error"] == "emailTaken") {
            echo "This email is taken. <a href=\"../login\">Log In?</button>";
        }

        if($_GET["error"] == "emailInvalid") {
            echo "Please enter a valid email address.";
        }

        if($_GET["error"] == "emailsDifferent") {
            echo "Please enter the same email address in both email address fields.";
        }

        if($_GET["error"] == "passwordInvalid") {
            echo "Please enter a valid password (minimum 8 characters).";
        }

        if($_GET["error"] == "passwordsDifferent") {
            echo "Please enter the same password in both password fields.";
        }

        if($_GET["error"] == "none") {
            echo "You are signed up! <a href=\"../login\">Log In?</button>";
        }

        echo "</p>";
    ?>
</form>
    
<?php include(dirname(__DIR__, $steps)."/footer/index.php")?>