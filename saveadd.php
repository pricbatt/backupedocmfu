

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
$folder = $_POST["folder"];
$file= $_POST["file"];
copy($folder.$file, "doc/".$file);
require 'connection_database.php';

          $name = $_POST["Firstname"];
          $id = $_POST["id"];
          $docname = $_POST["docname"];
          $topic = $_POST["topic"];     
          $type = $_POST["type"]; 
          $lastid = $_POST["lastid"]; 
          // $pdf=trim($_FILES["filUpload"]["name"]);
          // $file=trim($_FILES["file"]["name"]);
          $file=$_POST["file"];
          $created = date('Y-m-d H:i:s');
          $stamp = $_POST["stamp"];

//$sql = "DELETE FROM questions where id=$id;";
//$sql = "DELETE FROM answers where question_id=$id;";
$sql = "UPDATE form SET Firstname='$name',file='$file',docname='$docname',topic='$topic',created='$created',uid='$id',type='$type',stamp='$stamp' WHERE Id = $lastid ";

$result=mysqli_query($conn,$sql);

$query = mysqli_query($conn,$sql);
if ($query == TRUE) {
echo "<script type='text/javascript'>";
	echo "alert('Succesfuly');";
	echo "window.location = 'index.php'; ";
  echo "</script>";
  
}mysqli_close($conn);