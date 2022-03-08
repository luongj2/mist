<!--
    Name: Eric Liao
    Last Modified day: Mar 8 2022
    Purpose: Main Interface
-->
<?php 
//namespace (folder which the file should be)
session_start();
?>
<html>
    <head><title>Welcome | Mist</title></head>
    <body>
        <table>
            <tr>
                <th scope="col"><a href=
                <?php 
                $status_name = "Login In";
                if($_SESSION['isLogin'] == 1){
                    $status_name = "My Account";
                echo "userPage.php";}
                else {
                echo "userLogin.php";}?>> <?php echo $status_name ?>
                </th>

                <?php if($_SESSION['isLogin'] == 1){ 
                echo '<th><a href=userLogin.php?status=0>'. 'Log Out'.'</a></th>' ;
                }
            ?>

</tr>
</table>
</body>
</html>