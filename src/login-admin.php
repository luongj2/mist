<!--
    Name: Eric Liao
    Last Modified day: Mar 8 2022
    Purpose: Admin login interface
-->
<?php
session_start();
$status = $_POST['status'];
if($status == 0)
session_destroy(); 
?>
<html>
<head><title>Admin Log in | Mist </title></head>
<body>
<p><font color="#ff0000"><b><?php echo $_SESSION['message'] ?></b></font></p>
    
<form action ="../login.php" method ="POST">
    <fieldset>

    <legend>SIGN IN</legend>
    <style type="text/css">
                td {
                    line-height: 40px;

                    }
            </style>   
    <table>
<tr>
        <td>Email Address<td>
</tr>
       <tr>
           <td><input type="text" name="accountAD" size="15" maxlength="30" required ="required" /></td>
        </tr>

        <tr>
            <td>Password</td>
        </tr>
<tr>
        <td><input type="password" name="passwdLI" size="15" maxlength="30" required = "required" /></td>
</tr>

</table>
        <input style="width:150px"type="submit" name="signin" value="SIGN IN" /><br />
        <input style="width:150px"type="reset" name="reset" value="RESET" />
        <input type="hidden" name="isAdmin" value="1">
        </fieldset> 
        </form>

</body>
</html>