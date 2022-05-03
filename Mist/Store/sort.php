<?php 
/*
Planning for sorting and filter.
*/
function Search($pdo,$sid){
$query = "SELECT * FROM Games WHERE game_name REGEXP '$sid';"; 
$result = $pdo->query($query);
try{
    
    if(!empty($result)){ //Make sure result is not empty
while($row = $result->fetch_assoc()){ // Printing result

  //  echo "<tr><td scope='row' rowspan='2'> <img type='image' src='{$row['game_image']}' alt='add picture' width=100 height=100/></th>"; 
    echo "<tr><td>{$row['game_name']}</td>";
    echo "<td colspan='8' rowspan='2'>{$row['game_desc']}</td>";
    echo "<td rowspan='2'>{$row['create_date']}</td>";
   if($_SESSION['isLogin'] == 1){ 
    echo "<td rowspan='2'><a href='edit.php?ID={$_POST['ID']}'>[Edit]</td>";
    echo "<td rowspan='2'><a href=''>[View]</td></tr><br />";
    }
  
}
}
 else
    echo "No Such results, please try again.";
}
catch(PDOException $e){
    header('refresh:5;url=index.php');
    echo "Something wrong, please try again.<br />";
    echo '<b>Return after 5 seconds.  <a href="Admin/main.php">return</a></b>';
    exit;
}
}

/*
DEFAULT 
*/
 function printResult($pdo){
    $query = "SELECT * FROM Games";
    $result = $pdo->query($query);
    if(isset($result)){
    while($row = $result->fetch_assoc()){
      //  echo "</tr><td scope='row' rowspan='2'> <img type='image' src='.{$row['game_image']}' alt='add picture' width=100 height=100/></th>"; 
        echo "<td>{$row['game_name']}</td>";
        echo "<td colspan='8' rowspan='2'>{$row['game_desc']}</td>";
        echo "<td rowspan='2'>{$row['create_date']}</td>";
       if($_SESSION['isLogin'] == 1){ 
        echo "<td rowspan='2'><a href='edit.php?ID={$row['game_id']}'>[Edit]</td>";
        echo "<td rowspan='2'><a href=''>[View]</td></tr><br />";
        }
 }
}
else 
echo "Database empty.";
}

function SortByDate($pdo,$results){
  if(strcmp($results, 'ESC')==0){
    $query = "SELECT * FROM Games ORDER BY create_date";
  }
  else
  $query = "SELECT * FROM Games ORDER BY create_date DESC";

  $result = $pdo->query($query);
  while($row = $result->fetch_assoc()){
    //  echo "</tr><td scope='row' rowspan='2'> <img type='image' src='.{$row['game_image']}' alt='add picture' width=100 height=100/></th>"; 
      echo "<td>{$row['game_name']}</td>";
      echo "<td colspan='8' rowspan='2'>{$row['game_desc']}</td>";
      echo "<td rowspan='2'>{$row['create_date']}</td>";
      echo "<td rowspan='2'>{$row['game_like']}</td>";
     if($_SESSION['isLogin'] == 1){ 
      echo "<td rowspan='2'><a href='edit.php?ID={$_POST['ID']}'>[Edit]</td>";
      echo "<td rowspan='2'><a href=''>[View]</td></tr><br />";
      }
}
}
function SortByLike($pdo,$results){
  if(strcmp($results, 'ESC')==0){
    $query = "SELECT * FROM Games ORDER BY game_like";
  }
  else
  $query = "SELECT * FROM Games ORDER BY game_like DESC";

  $result = $pdo->query($query);
  while($row = $result->fetch_assoc()){
    //  echo "</tr><td scope='row' rowspan='2'> <img type='image' src='.{$row['game_image']}' alt='add picture' width=100 height=100/></th>"; 
      echo "<td>{$row['game_name']}</td>";
      echo "<td colspan='8' rowspan='2'>{$row['game_desc']}</td>";
      echo "<td rowspan='2'>{$row['create_date']}</td>";
      echo "<td rowspan='2'>{$row['game_like']}</td>";
     if($_SESSION['isLogin'] == 1){ 
      echo "<td rowspan='2'><a href='edit.php?ID={$_POST['ID']}'>[Edit]</td>";
      echo "<td rowspan='2'><a href=''>[View]</td></tr><br />";
      }
}
}
// Use to verifiying sorting direction
function Verifying($result){
  if(strcmp($result, 'ESC')==0){
   return $result = 'DESC';
}
else 
return $result = 'ESC';
}
?>
 