<?php 
namespace Mist\Store;
session_start();
include_once("../settings.php");
?>
<?php
 try{
    
    $pdo = new \mysqli(
        $settings['host'],$settings['username'],$settings['passwd'],$settings['dbname']
    );

}catch(PDOException $e){
    echo "Database connection failed";
    exit;
}

?>
<html>
    <head><title>Welcome | Mist</title></head>
    <script>
        function Forum() {
			document.location.href = "Forum/index.php";
			}
        </script>
    <body>
    <button onclick="Forum()">Forum</button><br />
        <style type="text/css">
            body{
                color: #000000;
background: #fffcfc url("images/bg.jpg");
font-family: Georgia, "Times New Roman", Times, serif;
font-size: 90%;
margin: 0px;
text-align: center;}
            a {
color: #000000;
text-decoration: none;}
a:hover {
color: #797373;}
.header {
padding: 40px 0px 0px 0px;
height: 100px;
position: auto;
top: 0px;
width: 100%;
z-index: 50;}
.nav {
float: right;
font-family: QuicksandBook, Helvetica, Arial, sans-serif;
padding: 0px 0px 0px 0px;
text-align: right;}
            </style>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="header">
            <div class="nav grid">
            <a href=<?php 
                $status_name = "Login In";
                if($_SESSION['isLogin'] == 1){
                    $status_name = "My Account";
                echo "userPage.php";}
                else {
                echo "userLogin.php";}?>><?php echo $status_name ?></a> /
                <?php if($_SESSION['isLogin'] == 1){ 
                echo '<a href=userLogin.php?status=0>'. 'Log Out'.'</a> /' ;
                }
            ?>
           <input type="text" name="search" style="width:100px;" /><button style="Height: 23px;">
                <img type="image" src="search.png" alt="add picture" width="10" height="10"/></button></div></div>
            </form>
</body>
</html>