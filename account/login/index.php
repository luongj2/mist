<?php
    session_start();

    if(isset($_SESSION["userID"])) {
        header("location: ../profile");
        exit();
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $title = "Log In";
    require(dirname(__DIR__, $steps)."/header/index.php");
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

        $error = $_GET["error"];
        
        echo "<p>";

        switch($_GET["error"]) {
            case "emptyFields":
                echo "Please fill in all fields!";
                break;
            case "emailNonexistent":
                echo "The email that you entered does not match our records.";
                break;
            case "incorrectPassword":
                echo "The password that you entered is incorrect.";
                break;
            case "none":
                header("location: ../../main");
                break;
        }
        
        echo "</p>";
    ?>
</form>
    
<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>