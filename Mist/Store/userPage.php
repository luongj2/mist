<?php session_start();?>
<html>
    <head><title>Account Overview | Mist</title></head>
    <body>
        <form>
        <p style='font-weight: bolder;'><?php echo 'WELCOME, '. $_SESSION['userName']; ?></p>
        <table>
            <tr><td>
       <a href = "userProfile.php"><input type="button" value="PROFILE" style="height:100px;width: 200px;"/></a><td>
       <td>
       <a href = "AddressBook.php"><input type="button" value="ADDRESS BOOK" style="height:100px;width: 200px;"/></a><td>
           
       </tr>
       <tr><td>
       <a href = "main.php"><input type="button" value="ORDER HISTORY" style="height:100px;width: 200px;"/></a><td>
       <td>
       <a href = "main.php"><input type="button" value="WISH LIST" style="height:100px;width: 200px;"/></a><td>
           
       </tr>

</table>
</form>
    </body>
</html>