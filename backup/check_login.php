<?php
   date_default_timezone_set('Asia/Bangkok');

?><?php
	session_start();
  $serverName = "localhost";
  $userName = "root";
  $userPassword = "1150";
  $dbName = "mfuworkshop";
    

	$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$strSQL = "SELECT * FROM member WHERE Username = '".mysqli_real_escape_string($objCon,$_POST['txtUsername'])."'
	and Password = '".mysqli_real_escape_string($objCon,$_POST['txtPassword'])."'";
	$objQuery = mysqli_query($objCon,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$objResult)
	{
			echo "<script>alert('Username and Password Incorrect!');</script>";
		header("Refresh:0; url=index.php");
	}
	else
	{
			$_SESSION["UserID"] = $objResult["UserID"];
			$_SESSION["Status"] = $objResult["Status"];

			session_start();
			if($_SESSION['UserID'] == "")
			  {
				  echo "Please Login!";
				  exit();
			  }

			  if($_SESSION["Status"] == "0")
			  {
				header("location:index.php");
				  exit();
			  }
			  if($_SESSION["Status"] != "0")
			  {
				header("location:index.php");
				  exit();
			  }

	}
	mysqli_close($objCon);
?>