<?php 
    $title = "New Game Request";
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

    <div class="newgame">
        <form action="form_action.php" method="post" enctype="multipart/form-data">
            <input type="text" name="gameName" placeholder="Name" required>
            <input type="number" name="companyID" placeholder="Company ID" min="1" required>
            <input type="text" name="gameGenre" placeholder="Genre" required>
            <input type="date" name="gameReleaseDate" placeholder="Release Date" required>
            <textarea name="gameDescription" placeholder="Description" rows="5" required></textarea>

            <div class="thumbnail_upload">
                <label for="gameThumbnail">Thumbnail</label>
                <input type="file" name="gameThumbnail" accept=".jpg, .jpeg, .png" required>
            </div>

            <div class="compatibility">
                <input type="checkbox" name="compatibleWindows" checked>
                <label for="compatibleWindows">Windows</label>
                <input type="checkbox" name="compatibleMacOS">
                <label for="compatibleMacOS">MacOS</label>
                <input type="checkbox" name="compatibleLinux">
                <label for="compatibleLinux">Linux</label>
            </div>
            <button name="submit">Submit</button>
        </form>
        <?php
            if (isset($_GET["request"]) == "success") {
                echo "<h1>Game Request Success</h1>";
            }
        ?>
    </div>
<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>