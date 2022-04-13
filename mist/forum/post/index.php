<?php
    if(!isset($_GET["id"])) {
        header("Location: ../store/search");
        return;
    }

    require "../functions.php";

    $postID = $_GET["id"];
    $post = getPostFromID($postID);

    $postName = $post["postName"];
    $postDescription = $post["postDescription"];
    $postLikes = $post["postLikes"];
    $postDate = $post["postDate"];

    $userID = $post["userID"];
    $user = getUserFromID($userID);

    $userFirstName = $user["userFirstName"];
    $userLastName = $user["userLastName"];

    $title = $postName;
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<?php
    echo "<div>";
    echo "<h1>$postName</h1>";
    echo "<h2>$postDescription</h2><br>";
    echo "<h3>User: $userFirstName $userLastName</h3><br>";
    echo "<h3>Release Date: $postDate</h3><br>";
    echo "<h3>Likes: $postLikes</h3>";
    echo "</div>";        
?>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>