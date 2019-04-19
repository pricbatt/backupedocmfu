

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
  $dbName = "webboard";
  $objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);

  $strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
  mysqli_query($objCon,"SET NAMES utf8");
  $objQuery = mysqli_query($objCon,$strSQL);
  $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
  
?><?php
require 'connection_database.php';
//question
$sql = "SELECT * FROM member WHERE UserID='{$_SESSION['UserID']}' ";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);


?>
<?php
header('Content-Type: application/json');
  move_uploaded_file($_FILES["filUpload"]["tmp_name"],"documents/".$_FILES["filUpload"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"],"doc/".$_FILES["file"]["name"]);
require 'connection_database.php';
        $name = $_POST["Firstname"];
        $id = $_POST["id"];
        $docname = $_POST["docname"];
        $topic = $_POST["topic"];     
        $type = $_POST["type"]; 
        $pdf=trim($_FILES["filUpload"]["name"]);
        $file=trim($_FILES["file"]["name"]);
        $created = date('Y-m-d H:i:s');
        $stamp = $_POST["stamp"];
$sql = "INSERT INTO form (Firstname,Filename,file,docname,topic,created,uid,type,stamp) VALUES ";
$sql .= "('{$name}','{$pdf}','{$file}','{$docname}','{$topic}','{$created}','{$id}','{$type}','{$stamp}')";

$query = mysqli_query($conn,$sql);


header('Location: index.php');
exit;

mysqli_close($conn);
