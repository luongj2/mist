<?php 
/*
Planning for admin to update the record.
*/
include_once('updateFunction.php');
include_once('../settings.php');
 try{
    
    $pdo = new \mysqli(
        $settings['host'],$settings['username'],$settings['passwd'],$settings['dbname']
    );

}catch(PDOException $e){
    echo "Database connection failed";
    exit;
}
$upPic = $_FILES['pic'];

updatePic($pdo,$upPic);
?>