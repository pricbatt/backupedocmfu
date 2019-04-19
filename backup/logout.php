<?php
   date_default_timezone_set('Asia/Bangkok');
  
?><?php
	session_start();
    session_destroy();
    echo "alert('ออกจากระบบแล้ว');";
	header("location:login.php");
?>