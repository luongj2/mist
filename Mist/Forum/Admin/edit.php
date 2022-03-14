<?php
namespace Mist\Forum\Admin;
include('../../settings.php');
$name = $_POST["name"];
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
<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
Name : <input type = "text" name = "name" value = "<?php echo $name;?>"?><br />
Content:<textarea name = "contents"><?php echo $content;?></textarea><br /> 
<input type = "submit" value =" <?php echo "Create";?>" />
</body>
</html>