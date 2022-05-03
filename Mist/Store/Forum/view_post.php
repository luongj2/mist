<?php
session_start();
        include_once("../../settings.php");
        include_once("functions.php");
        $pid = $_GET['post'];
       $date = date('Y-m-d H:i:s');
       $commentU =  $_POST['Ucomment'];
       $uid = $_SESSION['id'];
        try{
		 $pdo = new \mysqli(
        $settings['host'],$settings['username'],$settings['passwd'],$settings['dbname']
    );
	}catch(PDOException $e){
		echo "Database connection failed";
		exit;
	}
        try{
        if(array_key_exists('s',$_POST)){
                $sql = "INSERT INTO comments (postID, user_id, CommentDescription ,commentDate)
                VALUES 
                ('$pid','$uid','$commentU','$date')";
        $pdo->query($sql);
        } 
        }
        catch(Exception $e){
                $pdo->rollback();  
        }
        try{
                $result = $_POST['choice'];
                $num = 0;
                $cnt = 0;
                /**
                 * Verify which button the user selected.
                 */
                if(isset($result)){
                        if(strcmp($result,'like') == 0){
                                $num =1;
                        }
                        else
                                $num = 0;
                        }
                /**
                 * Verify if user already has operation on this post.
                 */
               if(checkExist($uid,$pid,$pdo) == 0){
                        $sql = "INSERT INTO Likes (user_id, postID, isLike)
                                VALUES ('$uid','$pid','$num')";
                }
                else{
                        $sql = "UPDATE Likes SET isLike = '$num' WHERE user_id = '$uid' AND postID = '$pid'";
                }
                $pdo->query($sql);
               }  
        catch(Excption $c){
                $pdo->rollback();  
        }
        $cnt = countLike($pid,$pdo);
        ?>
        <html>
        <script>
        function HomePage() {
			document.location.href = "index.php";
			}
        function autoSubmit(){
        var var1 = document.forms['likeSystem'];
    var1.submit();
}
        </script>
<body>
<button onclick="HomePage()">Home</button>
<?php
specifPost($pdo, $pid); 
?>

<!-- Using javascript function to automatic sumbit the form when the botton is been selected.-->
<form action ="<?php echo $_SERVER['PHP_SELF'].'?post='.$pid;?>" method = "POST" id="likeSystem">
<input id="like" type="radio" name="choice" value="like" <?php if ($result == 'like'){  print "checked='checked'"; }?> onchange="autoSubmit()"/>
<label for="female">Like</label>
<input id="dislike" type="radio" name="choice" value="dislike" <?php if ($result == 'dislike'){  print "checked='checked'"; }?>onchange="autoSubmit()"/>
<label for="female">Dislike</label>
</form>
<?php print "Count: ".$cnt; ?>
<!--$_SERVER['PHP_SELF'] is the provide path of current file-->
<form action ="<?php echo $_SERVER['PHP_SELF'].'?post='.$pid;?>" method = "POST">
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