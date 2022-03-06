<!--
    Name: Eric Liao
    Last Modified day: Mar 1 2022
    Purpose: logup interface
-->
<?php 
namespace example\BobsAutoPart;
include('../settings.php');
session_start();
/*
setting variables and get user logup values from logup.html
*/
$nameF = filter_input(INPUT_POST, 'fNameLU', FILTER_SANITIZE_STRING);
$nameL = filter_input(INPUT_POST, 'lNameLU', FILTER_SANITIZE_STRING);
$email1 = filter_input(INPUT_POST, 'emailLU', FILTER_VALIDATE_EMAIL);
$passwd1 = filter_input(INPUT_POST, 'passwdLU');
$ageValid = $_POST["ageValid"];

//Connect MYsql database
try{
    $pdo = new \PDO(
        sprintf('mysql:host=%s;dbname=%s',
        $settings['host'],$settings['dbname']),$settings['username'],$settings['passwd']);
}
catch(PDOException $e){
    header('refresh:5;url=main.php');
    echo "Something wrong, please try again.<br />";
    echo '<b>Return after 5 seconds.  <a href="main.php">return</a></b>';
    exit;
}
//Verifying user logup values and avoid hacking.
try{
    if(!isset($ageValid)){
        header( "refresh:5;url=logup.php" );
        echo "Please make sure you are above 18 years old.<br />";
        echo '<b>Return after 5 seconds.  <a href="logup.php">return</a></b></b>';
        exit;
    }
    else if(!$email1){
        header( "refresh:5;url=logup.php" );
            echo 'Invalid email<br />';
            echo '<b>Return after 5 seconds.  <a href="logup.php">return</a></b></b>';
            exit;
    }
    else if(mb_strlen($passwd1) < 8){
        header( "refresh:5;url=logup.php" );
        echo 'Password must contain 8+ characters<br />';
        echo '<b>Return after 5 seconds.  <a href="logup.php">return</a></b></b>';
            exit;
        }
        //password encryption
        else{
            $pdo->beginTransaction();
            $passwdErypt = password_hash(
                $passwd1,
                PASSWORD_DEFAULT
                //,['cost'=> 12] An explicitly given salt is ignored in PHP 8.0.0
            );
            //write values into database.
        $sql = ('INSERT INTO users(
            userFName,
            userLName,
            user_account,
            user_passwd
        )VALUES(:fNameLU,:lNameLU,:emailLU,:passwdLU)');
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':fNameLU',$nameF);
        $statement->bindValue(':lNameLU',$nameL);
        $statement->bindValue(':emailLU',$email1);
        $statement->bindValue(':passwdLU',$passwdErypt);
        $statement->execute();
        $pdo->commit();
        }
    


}catch(Exception $e){
   $pdo->rollback();
    echo "Something wrong, please try again.";
    $e->getMessage();
}
//Link to login interface and close the database connection.
header('Location:userLogin.php');
$pdo->close();

?>