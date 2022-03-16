<?php 
    $title = "Log In";
    include(dirname(__DIR__)."/includes/php/header.php");
?>

    <link rel="stylesheet" href="login.css">    

    <div class="title">
        Log In
    </div>

    <form action="login.php" method="post"> 
        <div class="form">
            <input type="text" name="userEmail" placeholder="Email">
            <input type="password" name="userPassword" placeholder="Password">
        </div>

        <div class="submit">
            <button name="submit">Log In</button>
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

        if($_GET["error"] == "emailInvalid") {
            echo "The email that you entered does not match our records.";
            return;
        }

        if($_GET["error"] == "passwordInvalid") {
            echo "The password that you have entered is incorrect.";
            return;
        }
        
        echo "</p>";
    ?>
    
<?php include(dirname(__DIR__)."/includes/php/footer.php")?>