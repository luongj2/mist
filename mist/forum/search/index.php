<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $steps = 2;
    require(dirname(__DIR__, $steps)."/database.php");
    require(dirname(__DIR__, $steps)."/functions.php");

    $title = "Mist Store";
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
                
                $postName = $post["postName"];
                $postAuthor = $post["postAuthor"];
                $postDescription = $post["postDescription"];
                $postLikes = $post["postLikes"];
                $postDate = $post["postDate"];

                echo "
                    <a href=\"../post/index.php?postID=$postID\">
                        <li>
                            <b>$postName</b>
                            <b>$postAuthor</b>
                            <p>$postDescription</p>
                            <p>$postDate</p>
                            <p>$postLikes</p>
                        </li>
                    </a>
                ";
            }
        ?>
    </ul>
</div>

<?php
    require(dirname(__DIR__, $steps)."/footer/index.php")
?>