<!--
    Name: Eric Liao
    Last Modified day: Mar 6 2022
    Purpose: Login check and verification
-->
<?php
namespace example\BobsAutoPart;
include('../settings.php'); 
session_start();

//Get user information from interface
$passwd1 = filter_input(INPUT_POST,'passwdLI');
$validmail = filter_input(INPUT_POST,'emailAddressLI', FILTER_VALIDATE_EMAIL);
try{
    
    $pdo = new \mysqli(
        $settings['host'],$settings['username'],$settings['passwd'],$settings['dbname']
    );

}catch(PDOException $e){
    echo "Database connection failed";
    exit;
}
try{
    //verification process
    if(!$validmail){
        header('Location:userLogin.php');
        $_SESSION['message'] = "Please Entry vaild email";
        exit;
    }else{
        $pdo->begin_transaction();
        $sql =("SELECT * , CONCAT(UPPER(u.userFName),' ',UPPER(u.userLName)) AS userName1 FROM users u WHERE u.user_account = '$validmail'");
        $vaild = $pdo->query($sql);
        $pdo->commit();
        $row = $vaild->fetch_assoc();
        if (strcasecmp($row['user_account'],$validmail)==0 & password_verify($passwd1, $row['user_passwd'])){
            header('Location:main.php');

            //Store user id and login information on the server for later use.
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['userName'] = $row['userName1'];
                $_SESSION['isLogin'] = 1; 
        }
        else{ 
            header('Location:userLogin.php');
            $_SESSION['message'] = "Either the login id or password you entered is incorrect. Please try again.";
            exit;
        }
    }
}
catch(Exception $e){
    $pdo->rollback();
    $_SESSION['message'] = "Something wrong, please try again.";
    exit;
}


$pdo ->close();
?>