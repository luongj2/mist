<?php 
    $title = "Sign Up";
    $steps = 2;
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
        
        $error = $_GET["error"];
        
        echo "<p>";

        switch($_GET["error"]) {
            case "emptyFields":
                echo "Please fill in all fields!";
                break;
            case "emailTaken":
                echo "This email is taken. <a href=\"../login\">Log In?</button>";
                break;
            case "invalidEmailFormat":
                echo "Please enter a valid email address.";
                break;
            case "invalidPasswordFormat":
                echo "Please enter a valid password (minimum 8 characters).";
                break;
            case "differentEmails":
                echo "Please enter the same email address in both email address fields.";
                break;
            case "differentPasswords":
                echo "Please enter the same password in both password fields.";
                break;
            case "none":
                echo "You are signed up! <a href=\"../login\">Log In?</button>";
                break;
        }
        
        echo "</p>";
    ?>
</form>
    
<?php include(dirname(__DIR__, $steps)."/footer/index.php")?>