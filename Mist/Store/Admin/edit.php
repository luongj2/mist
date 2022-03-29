<?php
namespace Mist\Store\Admin;
include('../../settings.php');
$name = $_POST["ID"];
if(isset($name)){
	$create  = "Update";
}else
$create = "Create";
if ($name!= ""){
	$content = $_POST['contents'];
	$note_date = date('Y-m-d H:i:s');
	try{
		$pdo = new \PDO(
		sprintf('mysql:host=%s;dbname=%s', 
		$settings['host'], $settings['dbname']),$settings['username'],$settings['passwd']);

	}catch(PDOException $e){
		echo "Database connection failed";
		exit;
	}
	try{
		$sql = ("INSERT INTO usermessage (author, note_date, note_text,reply) values('$name', '$note_date','$content','')");
		$pdo->exec($sql);
	}catch(Exception $error){
		$pdo->rollback();
		echo "Saved not completed." ;
	}
	$pdo = NULL;
}
?>
<html>
<style>
</style>
<body text = "#000000" >
<p><a href = "main.php"> Return </a></P>

<!--Make sure code include "enctrype" to allow PHP to send file via POST.-->
<form action = "../update.php" method = "POST" enctype="multipart/form-data">
Name : <input type = "text" name = "name" value = "<?php echo $name;?>"?><br />
Description:<textarea name = "contents" placeholder="Enter the description of your game here..."><?php echo $content;?></textarea><br /> 
Picture:  <input type="file" name="pic" accept="image/*"/><br/><br />
Types of Game(Choose least one):<br /><input type="checkbox" name="genre" value="adventure" checked="checked"/>Adventure
<input type="checkbox" name="genre" value="sandbox" />SandBox
<input type="checkbox" name="genre" value="openworld" />Openworld
<input type="checkbox" name="genre" value="FPS" />FPS<br />
<input type="checkbox" name="genre" value="partygame" />PartyGame
<input type="checkbox" name="genre" value="sports" />Sports
<input type="checkbox" name="genre" value="survival & horror" />Survival & Horror</p>
<input type = "submit" value =" <?php echo $create;?>" />
</body>
</html>