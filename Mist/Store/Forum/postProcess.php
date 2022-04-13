<?php
/*
For edit.html . Helping to Create new post and save it to database.
*/
namespace Mist\Store\Forum;
session_start();
include_once('../../settings.php');
if(isset($name)){
	$create  = "Update";
}else
$create = "Create";
$name = $_POST['name'];
	$content = $_POST['contents'];
	$post_date = date('Y-m-d H:i:s');
	if(isset($_POST['title'])){
	$title = $_POST['title'];
	}
	else 
	$title = substr($_POST['title'],0,15);
	try{
		$pdo = new \PDO(
		sprintf('mysql:host=%s;dbname=%s', 
		$settings['host'], $settings['dbname']),$settings['username'],$settings['passwd']);

	}catch(PDOException $e){
		echo "Database connection failed";
		exit;
	}
	try{
		/*
		Saving Post to the database
		*/
		$sql = ("INSERT INTO posts (postName,user_id, postDate, post_title,postDescription) 
				VALUES('$name','{$_SESSION['id']}','$post_date','$title','$content')");
		$pdo->exec($sql);
		header( "refresh:5;url=index.php" );
        echo "Add Success!<br />";
        echo '<b>Return Within 5 seconds.  <a href="index.php">return</a></b></b>';
	}catch(Exception $error){
		$pdo->rollback();
		echo "Saved not completed." ;
	}
	$pdo = NULL;
?>