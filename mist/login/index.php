<?php 
    $title = "Log In";
    $steps = 1;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>


<form action="login.php" method="post">
    <h1>Log In</h1>

    <?php 
        function createInput($type, $name, $placeholder) {
            echo "<input type=\"$type\" name=\"$name\" placeholder=\"$placeholder\">";
        }

        createInput("text", "userEmail", "Email");
        createInput("password", "userPassword", "Password");
    ?>

    <button name="submit">Submit</button>

    <?php
        if(!isset($_GET["error"])) {
            return;
        }
        
        echo "<p>";

        if($_GET["error"] == "emptyInput") {
            echo "Please fill in all fields!";
        }

        if($_GET["error"] == "emailInvalid") {
            echo "The email that you entered does not match our records.";
        }

        if($_GET["error"] == "passwordInvalid") {
            echo "The password that you entered is incorrect.";
        }
        
        echo "</p>";
    ?>
</form>
    
<?php include(dirname(__DIR__, $step)."/footer/index.php")?>