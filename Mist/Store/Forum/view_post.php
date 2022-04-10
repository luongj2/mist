        <html>
        <?php
        include_once("../../settings.php");
        include_once("functions.php");
       $pid = $_GET['post'];
       $date = date('Y-m-d H:i:s');
       $commentU =  $_POST['Ucomment'];
        try{
		 $pdo = new \mysqli(
        $settings['host'],$settings['username'],$settings['passwd'],$settings['dbname']
    );
	}catch(PDOException $e){
		echo "Database connection failed";
		exit;
	}
        if(array_key_exists('s',$_POST)){
                $sql = "INSERT INTO comments (postID, CommentDescription ,commentDate)
                VALUES 
                ('$pid','$commentU','$date')";
        $pdo->query($sql);
        }
        ?>
        <script>
        function HomePage() {
			document.location.href = "index.php";
			}
        </script>
<body>
<button onclick="HomePage()">Home</button>
<?php
specifPost($pdo, $pid); 
?>
<!--$_SERVER['PHP_SELF'] is the provide path of current file-->
<form action ="<?php echo $_SERVER['PHP_SELF']."?post=$pid";?>" method = "POST">
<textarea name="Ucomment" placeholder="Write some comments here..." style="resize: none;"rows="10" cols="50" maxlength="500" ></textarea>
<br /> 
<input type="submit" name='s' value="SUBMIT"/>
        </form>
        <?php
printComment($pdo, $pid);
$pdo->close();
?>
</body>
</html>