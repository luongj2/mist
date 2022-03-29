<?php 
namespace Mist\Store\Admin;
session_start();
include_once("../../settings.php");
include_once("../sort.php");
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
    <body>
        <style type="text/css">
            body{
                color: #000000;
background: #fffcfc url("images/bg.jpg");
font-family: Georgia, "Times New Roman", Times, serif;
font-size: 90%;
margin: 0px;
text-align: right;}
            a {
color: #000000;
text-decoration: none;}
a:hover {
color: #797373;}
#header {
padding: 40px 0px 0px 0px;
height: 100px;
position: fixed;
top: 0px;
width: 100%;
z-index: 50;}
.nav {
float: right;
font-family: QuicksandBook, Helvetica, Arial, sans-serif;
padding: 0px 0px 0px 0px;
text-align: right;}
li{
    display:inline;
    padding:0.5em;
}

            </style>


        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div id="header">
            <div id="nav">
                <ul>
            <li><a href=<?php 
                $status_name = "Login In";

                if($_SESSION['isLogin'] == 1){
                    $status_name = "My Account";
                echo "userPage.php";} 

                else {
                echo "login.php";}?>><?php echo $status_name ?></a></li>

                <?php if($_SESSION['isLogin'] == 1){ 
                echo '/ <li><a href=login.php?status=0>'. 'Log Out'.'</a></li>' ;
                }

            ?>
           <li><input type="search" name="search" style="width:100px;" /><button style="Height: 23px;">
                <img type="image" src="../search.png" alt="add picture" width="10" height="10"/></button></li>
            </ul></div>
            </form>
            <table style="text-align:center;">
            <th></th>
           <th scope="col">Game's Name</th>
           <th scope="col" colspan="8">Discription</th>
           <th scope="col">Add Time</th>
           <th scope="col">Game ID</th>
           <!--If User does not use search function, display default settings-->
               <?php 
               if(!empty($_POST['search']))
               Search($pdo,$_POST['search']);
               else{
               printResult($pdo);}
               ?>
            </table>
                
</body>
</html>