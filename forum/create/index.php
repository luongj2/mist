<?php
    $title = "Create Post";
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <form action="create.php" method="post">
        <h1>Create Post</h1>

        <input type="text" name="postName" placeholder="Name">
        <textarea name="postDescription" placeholder="Description" rows="8"></textarea>
        
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
                case "none":
                    echo "Post created!";
                    break;
            }
            
            echo "</p>";
        ?>
    </form>
</div>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>