
<?php
/*
Purpose: When user upload pictures, we move it to our folder.
*/
function updatePic($pdo,$upfile,$UID){
$fileInfo = pathinfo($upfile['name']);
$typelist=array("image/jpeg","image/jpg","image/png","image/gif"); #checking if the type of picture upload is invaild.
$path = "./Pictures/"; #The path where the folder located.
$filePath = $fileInfo['basename'];
#Get Error message.
if($upfile['error']>0){
    Switch($upfile['error']){
            case 1:    
                $info="OverSize!";
                break;
            case 2:
                $info="OverSize!";
                break;
            case 3:
                $info="Partical image are uploaded!";
                break;
            case 4:
                $info="No file are uploaded!";
                break;
            case 5:
                $info="Can not found folder!";
                break;
            case 6:
                $info="File writing failed!";
                break;
        }die("Upload Failed, Possible resason:".$info);
}
if(!in_array($upfile['type'],$typelist)){
    die("Please check your file's format".$upfile["type"]);
}
if(is_uploaded_file($upfile['tmp_name'])){
    if(move_uploaded_file($upfile['tmp_name'],$path.$filePath)){ 
        
        #Save the path into the database.
        $sql = "UPDATE 
                        usermessage 
                SET 
                        game_image = $path$upfile
                WHERE   
                        game_id = {$UID}";
                    
                   $pdo->query($sql);
                echo "successed!";
    }
    else 
    echo "Upload failed!";
}
}
?>