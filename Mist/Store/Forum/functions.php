
<?php
/*
Print All Comment for specific post
Page Flip Included.
*/
function printComment($pdo,$pid){
$query = "SELECT * from comments WHERE postID = $pid";
$result = $pdo->query($query);
	$totalnum = $result->num_rows;
$pagesize = 7;

$page = $_GET['page'];
if($page == null)
$page = 1;
$start =($page-1) * $pagesize;
$end = $start + $pagesize;
$pagenum = ceil($totalnum/$pagesize);
$row = $page * $pagesize;
$query = "SELECT * FROM comments WHERE postID = $pid  order by commentDate DESC limit $start,$pagesize";
$result = $pdo->query($query);
while($row = $result->fetch_assoc()){
	echo " [  {$row['user_id']}  ] since   {$row['commentDate']}  say: <br />";
	echo " {$row['CommentDescription']} <br /><hr /> ";

}

for($i=1; $i <= $pagenum; $i++){
	echo '<a href=view_post.php?post='.$pid.'&&page='. $i .'>'. '['. $i. ']</a>';
};
echo "<br />";
}
/*
Print specific post
*/
function specifPost($pdo,$pid){
	$sql = "SELECT *, CONCAT(UPPER(post_title)) AS postsT FROM posts WHERE postID = $pid";
	$result = $pdo -> query($sql);
	$row = $result->fetch_assoc();
	echo "<h1>{$row['postsT']}</h1>";
	echo "By <b>{$row['postName']}</b><br />";
	echo "<p>{$row['postDescription']}</p>";
	
}
/*
Print all post in main page
Page Flip Included.
*/
function printPosts($pdo){
	$sql = "SELECT * FROM posts";
	$result = $pdo -> query($sql);
	if($result->num_rows < 1){echo "currenly do not have any blogs";
		exit;
	}else 
		$totalnum = $result->num_rows;
$pagesize = 10;

$page = $_GET['page'];
if($page == null)
$page = 1;
$start =($page-1) * $pagesize;
$end = $start + $pagesize;
$pagenum = ceil($totalnum/$pagesize);
$row = $page * $pagesize;
$query = "SELECT *, CONCAT(UPPER(post_title)) AS postsT FROM posts order by postDate DESC limit $start,$pagesize";
$result = $pdo->query($query);
while($row = $result->fetch_assoc()){
	echo '<a href=view_post.php?post='.$row['postID'].'>'."<p><button>{$row['postsT']}<br />";
	if(strlen($row['postDescription']) > 15){
		$content = substr($row['postDescription'],0,15);
	echo "$content...<br />";}
	else
	echo "{$row['postDescription']}<br />";
	echo "By "."{$row['postName']}<br />";
	echo '</button></a></p>';
}

for($i=1; $i <= $pagenum; $i++){
	echo '<a href=index.php?page='. $i .'>'. '['. $i. ']</a>';
};
echo "<br />";
}