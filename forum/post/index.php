<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_GET["postID"])) {
        header("location: ../search");
        return;
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $postID = $_GET["postID"];
    
    $post = callProcedure("spGetPostFromID", $postID)[0];
    
    $postAuthor = $post["postAuthor"];
    $postName = $post["postName"];
    $postDescription = $post["postDescription"];
    $postLikes = $post["postLikes"];
    $postDate = $post["postDate"];
    $postDeleted = $post["postDeleted"];

    $postName = ($postDeleted == 1 ? "[DELETED] " . $postName: $postName);

    $title = $postName;
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <?php
        echo "
            <h1>$postName</h1><br>
            <h2>$postDescription</h2><br>
            <h3>$postAuthor</h3><br>
            <h3>$postDate</h3><br>
            <h3>$postLikes</h3><br>
        ";
        
        if(isset($_SESSION["userID"])) {
            if($_SESSION["userRole"] == "admin" || $_SESSION["userRole"] == "mod") {
                if($postDeleted == 0) {
                    echo "
                        <form action=\"post.php?postID=$postID\" method=\"post\">
                            <button name=\"submit\">Delete Post</button>
                        </form>
                    ";
                }
            }
        }
    ?>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>