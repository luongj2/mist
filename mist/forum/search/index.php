<?php 
    $title = "Mist Store";
    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");
    require(dirname(__DIR__, $steps)."/header/index.php");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div>
    <form action="search.php" method="post">
        <input type="text" name="search" placeholder="Search">

        <button name="submit"><i class="fa fa-search"></i></button>
        
        <select name="sort">
            <option value="none">Sort By</option>
            <option value="date">Date</option>
            <option value="likes">Likes</option>
        </select>

        <?php
            if(isset($_SESSION["userID"])) {
                echo "<a href=\"../create/\">Create Post</a>";
            }
        ?>
    </form>

    <ul>
        <?php
            $search = getSearchQuery("search");
            $sort = getSearchQuery("sort");

            $posts = callProcedure("spGetPostsFromSearch", $search, $sort);

            foreach($posts as $post) {
                $postID = $post["postID"];
                
                $post = callProcedure("spGetPostFromID", $postID)[0];
                
                $postAuthor = $post["postAuthor"];
                $postName = $post["postName"];
                $postDescription = $post["postDescription"];
                $postLikes = $post["postLikes"];
                $postDate = $post["postDate"];

                echo "<a href=\"../post/index.php?id=$postID\">";
                echo "<li>";
                echo "<h1>$postName</h1><br>";
                echo "<h3>$postDescription</h3><br>";
                echo "<h4>$postAuthor</h4><br>";
                echo "<p>Date Posted: $postDate</p><br>";
                echo "<p>Likes: $postLikes</p><br>";
                echo "</li>";
                echo "<br>";
                echo "</a>\n";
            }
        ?>
    </ul>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>