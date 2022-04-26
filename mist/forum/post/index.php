<?php
    if(!isset($_GET["id"])) {
        header("Location: ../store/search");
        return;
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $postID = $_GET["id"];
    
    $post = callProcedure("spGetPostFromID", $postID)[0];
    
    $postAuthor = $post["postAuthor"];
    $postName = $post["postName"];
    $postDescription = $post["postDescription"];
    $postLikes = $post["postLikes"];
    $postDate = $post["postDate"];

    $title = $postName;
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<div>
    <?php
        echo "<h1>$postName</h1>";
        echo "<h2>$postDescription</h2><br>";
        echo "<h3>User: $postAuthor</h3><br>";
        echo "<h3>Release Date: $postDate</h3><br>";
        echo "<h3>Likes: $postLikes</h3>";   
    ?>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>