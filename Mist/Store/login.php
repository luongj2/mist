<?php
namespace Mist\Store;
include('../settings.php'); 
session_start();
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
    $pdo->begin_transaction();
        $sql =("SELECT * 
                FROM   Admin 
                WHERE admin_account = '{$_POST['accountAD']}'");
        $vaild = $pdo->query($sql);
        $pdo->commit();
        $row = $vaild->fetch_assoc();
        if (strcasecmp($row['admin_account'],$_POST['accountAD'])==0 & $_POST['passwdAD'] == $row['admin_passwd']){
            header('Location:Admin/main.php');

                $_SESSION['userName'] = Admin;
                $_SESSION['isLogin'] = 1;
}   
else{ 
    header('Location:Admin/login.php');
    $_SESSION['message'] = "Either the login id or password you entered is incorrect. Please try again.";
    exit;
}
}

else {

    $passwd1 = filter_input(INPUT_POST,'passwdLI');
      $validmail = filter_input(INPUT_POST, 'emailLI', FILTER_VALIDATE_EMAIL);

     if(!$validmail){
        header('Location:userLogin.php');
        $_SESSION['message'] = "Please Entry vaild email";
        exit;
    } 
    else{
        $pdo->begin_transaction();
        $sql =(
        "SELECT * ,
         CONCAT(UPPER(userFName),
         ' ',
         UPPER(userLName)) AS userName1 
         FROM                 users 
         WHERE                user_account = '$validmail'");
        $vaild = $pdo->query($sql);
        $pdo->commit();
        $row = $vaild->fetch_assoc();
        if ( strcasecmp($row['user_account'],$validmail) ==0 & password_verify($passwd1, $row['user_passwd'])){
            header('Location:index.php');
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['userName'] = $row['userName1'];
                $_SESSION['isLogin'] = 1;}

        else{ 
            header('Location:userLogin.php');
            $_SESSION['message'] = "Either the login id or password you entered is incorrect. Please try again.";
            exit;
        }
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