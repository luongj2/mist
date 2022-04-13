<?php 
    $title = "Request Game";
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <form action="request.php" method="post" enctype="multipart/form-data">
        <h1>Request Game</h1>

        <input type="text" name="gameName" placeholder="Name">
        <textarea name="gameDescription" placeholder="Description" rows="5"></textarea>
        <input type="text" name="gameGenre" placeholder="Genre">

        <div class="compatibility">
            <input type="checkbox" name="compatibleWindows">
            <label for="compatibleWindows">Windows</label>
            <input type="checkbox" name="compatibleMacOS">
            <label for="compatibleMacOS">MacOS</label>
            <input type="checkbox" name="compatibleLinux">
            <label for="compatibleLinux">Linux</label>
        </div>

        <div class="thumbnail_upload">
            <label for="gameThumbnail">Thumbnail</label>
            <input type="file" name="gameThumbnail" accept=".jpg, .jpeg, .png">
        </div>

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
                case "emptyChecks":
                    echo "Please make sure there is a compatible operating system!";
                    break;
                case "emptyThumbnail":
                    echo "Please make sure you upload a thumbnail!";
                    break;
                case "none":
                    echo "Game requested!";
                    break;
            }
            
            echo "</p>";
        ?>
    </form>
</div>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>