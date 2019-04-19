<?php
   date_default_timezone_set('Asia/Bangkok');
  
?>
<?php
header('Content-Type: text/html; charset=utf-8');

  session_start();
  if($_SESSION['UserID'] == "")
  {
    echo "Please Login!";
   header("Refresh:0; url=login.php");
    exit();
  }
    
  
 
  
  
$serverName = "localhost";
  $userName = "root";
  $userPassword = "1150";
  $dbName = "mfuworkshop";
    

  $objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);

  $strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
  mysqli_query($objCon,"SET NAMES utf8");
  $objQuery = mysqli_query($objCon,$strSQL);
  $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);

  ?>  
  <?php

  require 'connection_database.php';
  //question
  $sql = "SELECT * FROM form WHERE id='{$_GET['id']}' ";
  $query = mysqli_query($conn,$sql);
  $result = mysqli_fetch_assoc($query);
  
  if ($_SESSION['UserID'] != $result['uid'])
	{
	  
	  echo "<script type=\"text/javascript\">";
  echo "alert(\"Can't Delete\");";
  echo "window.history.back();";
  echo "</script>";
  
	  
	  exit();
	}
  
  ?>
<?php

require 'connection_database.php';
$id=$_GET['id'];

//$sql = "DELETE FROM questions where id=$id;";
//$sql = "DELETE FROM answers where question_id=$id;";
$sql="DELETE FROM form where id=$id;";
$result=mysqli_query($conn,$sql);



$query = mysqli_query($conn,$sql);
if ($query == TRUE) {
echo "<script type='text/javascript'>";
	echo "alert('delete Succesfuly');";
	echo "window.location = 'index.php'; ";
	echo "</script>";
}
mysqli_close($conn);