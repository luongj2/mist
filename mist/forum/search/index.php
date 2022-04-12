<?php 
    $title = "Mist Store";
    $steps = 2;
    include(dirname(__DIR__, $steps)."/header/index.php");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="store">
    <form action="search.php" method="post">
        <div class="search-box">
            <input type="text" name="search" placeholder="Search">

            <button name="submit"><i class="fa fa-search"></i></button>
            
            <div class="dropdown">
                <select name="sort">
                    <option value="none">Sort By</option>
                    <option value="date">Date</option>
                    <option value="likes">Likes</option>
                </select>
            </div>
        </div>

        <?php
            if(isset($_SESSION["userID"])) {
                echo "<a href=\"../create/\">Create Post</a>";
            }
        ?>
    </form>

    <ul>
        <?php
            require "../functions.php";

            $search = getSearchQuery("search");
            $sort = getSearchQuery("sort");

            $posts = getPostsFromSearch($search, $sort);

            foreach($posts as &$post) {
                $postID = $post["postID"];
                $userID = $post["userID"];
                $postName = $post["postName"];
                $postDescription = $post["postDescription"];
                $postLikes = $post["postLikes"];
                $postDate = $post["postDate"];
                echo "<a href=\"../game/index.php?id=$postID\">";
                echo "<li>";
                echo "<p>$postName</p><br>";
                echo "<p>$postDescription</p><br>";
                echo "<p>$postDate</p><br>";
                echo "<p>$postLikes</p><br>";
                echo "</li>";
                echo "</a>\n";
            }
        ?>
    </ul>
</div>

<?php
    include(dirname(__DIR__, $steps)."/footer/index.php")
?>