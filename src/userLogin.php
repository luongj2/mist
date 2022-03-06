<!--
    Name: Eric Liao
    Last Modified day: Mar 6 2022
    Purpose: login interface
-->
<?php 
session_start();
$status = $_POST['status'];
//Logout method
if($status == 0)
session_destroy(); ?>
<html>
<head><title>Register or Log in | CookiePerfect</title></head>
<body>
        <!--Print error message-->
<p><font color="#ff0000"><b><?php echo $_SESSION['message'] ?></b></font></p>
    
<form action ="login.php" method ="POST">
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
           <td><input type="text" name="emailAddressLI" size="15" maxlength="30" required ="required" /></td>
        </tr>

        <tr>
            <td>Password</td>
        </tr>
<tr>
        <td><input type="password" name="passwdLI" size="15" maxlength="30" required = "required" /></td>
</tr>

</table>
<!--link to password changing interface

        <p><a href="forgetPd.php">Forget Password?</a></p>-->
        <input style="width:150px"type="submit" name="signin" value="SIGN IN" />
        </fieldset> 
        </form>
        Not a member? <a href ="logup.html">Join Us</a>

</body>
</html>