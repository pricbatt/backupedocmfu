<?php
header('Content-Type: text/html; charset=utf-8');

  session_start();
  if($_SESSION['UserID'] == "")
  {
    header('Location: index.php');
   // header("Refresh:0; url=index.php");
    exit();}
  // }if($_SESSION["Status"] == "1")
  //       {
  //       header("location:welcome1.php");
  //         exit();
  //       }
       


  
  require 'connection_database.php';

  $strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
  mysqli_query($conn,"SET NAMES utf8");
  $objQuery = mysqli_query($conn,$strSQL);
  $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขข้อมูล</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    #signature-pad{
        border: 1px solid #cccc;
    }
    </style>
</head>
<body>
    <div class="container">
    <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> เพิ่มเอกสาร</h1>
    <?php echo $objResult["name"];?>
    <form id="new_topic" name="new_topic" method="post" action="saveadd.php" enctype="multipart/form-data">
    
        <div class="form-group">
            <label>ชื่อ</label>
            <input value=" <?php echo $objResult["name"];?>" type="text" class="form-control" name="Firstname" id="Firstname" placeholder="<?php echo $objResult["name"];?>">
        </div>
        <div class="form-group">
            <label>นามสกุล</label>
            <input value=" <?php echo $objResult["lastname"];?>" type="text" class="form-control" name="Lastname" id="Lastname" placeholder="<?php echo $objResult["lastname"];?>">
        </div>
        <div class="form-group">
            <label>เลขหนังสือ</label>
            <input  type="text" class="form-control" name="docname" id="docname" placeholder="เลขหนังสือ">
        </div>
        <div class="form-group">
            <label>เรื่อง</label>
            <input  type="text" class="form-control" name="topic" id="topic" placeholder="เรื่อง">
        </div>
        <div class="form-group">
            <label>เอกสาร</label>
            <input type="file" name="filUpload">
        </div>
        
       
        
     
    
        <button type="submit" class="btn btn-primary" id="Submit" name="Submit">
            <span class="glyphicon glyphicon-floppy-disk"></span>
            บันทึกข้อมูล
        </button>

        <!-- <input type="submit" name="Submit" value="บันทึกข้อมูล" class='glyphicon glyphicon-floppy-disk'> -->
            
        <a href="myindex.php" class="btn btn-default">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> หน้าหลัก
        </a>
      
    </form>
    
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

</body>
</html>