<?php
namespace Mist\Store\Forum;
include_once('../../settings.php');
include_once('functions.php');
?>

<html>
<head><title> Welcome to Mist's Forum</title></head>
<script>
        function Edit() {
			document.location.href = "edit.html";
			}
        </script>
<body  text = "#000000">
<h1> Welcome to Mist's Forum</h1>
<button onclick="Edit()">Edit</button><br />
<?php
try{
$pdo = new \mysqli(
	$settings['host'], $settings['username'], $settings['passwd'], $settings['dbname']);
}catch(PDOException $e){
    echo "Database connection failed";
    exit;
}
?>
<?php
printPosts($pdo);
?>
</body>
</html>