<?php
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database/database.php");

    if(!isset($_GET["id"])) {
        header("Location: ../store/search");
        return;
    }

    $postID = $_GET["id"];
    $post = callProcedure("spGetPostFromID", $postID)[0];

    $title = $post["postName"];
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<?php
    $postName = $post["postName"];
    $postDescription = $post["postDescription"];
    $postLikes = $post["postLikes"];
    $postDate = $post["postDate"];

    $userID = $post["userID"];
    $user = callProcedure("spgetUserFromID", $userID)[0];

    $userFirstName = $user["userFirstName"];
    $userLastName = $user["userLastName"];

    echo "<div>";
    echo "<h1>$postName</h1>";
    echo "<h2>$postDescription</h2><br>";
    echo "<h3>User: $userFirstName $userLastName</h3><br>";
    echo "<h3>Release Date: $postDate</h3><br>";
    echo "<h3>Likes: $postLikes</h3>";
    echo "</div>";        
?>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>