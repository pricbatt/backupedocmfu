<?php
    require 'connection_database.php';
    $Id = $_GET["id"];

    if(isset($_POST["btnSubmit"])){
        
        
      
        $answer = $_POST["answer"];
        $Approved = $_POST['Approved'];
        // $Approved = 0;
        
       
        // if (isset($_POST['Approved'])) {
        //     $Approved = 1;
        // }
        $sql = "UPDATE form SET answer='$answer',
                Approved=$Approved            
                WHERE Id = $Id ";
        $conn->query($sql);
       
        echo "<script type='text/javascript'>";
	echo "alert('บันทึกข้อมูล!!!');";
	echo "window.location = 'index.php'; ";
	echo "</script>";
    }

    $sql = "SELECT * FROM form WHERE Id = $Id ";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
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
    <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> แก้ไขข้อมูล</h1>
    <form method="post" action="edit_user.php?id=<?=$Id?>">
        <div class="form-group">
            <label>ชื่อ - สกุล</label>
            <input value="<?=$row["Firstname"]?>" type="text" class="form-control" name="Firstname" id="Firstname" placeholder="Firstname" readonly>
        </div>
  
        <div class="form-group">
            <label>เอกสาร : </label>
            <a href="preview.php?id=<?=$row["Id"]?>" target="_blank">รายละเอียด</a>
        </div>
        <!-- <div class="checkbox">
            <label>
                <input value="1" <?php if($row["Approved"]==1) { echo "checked='checked'"; } ?> type="checkbox" name="Approved" id="Approved"> อนุมัติ
                
            </label>
            <label> <input value="2" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> type="checkbox" name="Approved" id="Approved"> ไม่อนุมัติ</label>
          
        </div> -->
        <div class="selectbox">
            <label>การตอบรับ : </label>
                <select name="Approved" id="Approved">
                <option value="0">Select</option>                
                <option value="3">รับทราบ</option>
                <option value="4">ไม่สามารถดำเนินการ</option>           
                </select>
        </div>
      
        <div class="form-group">
            <label>เหตุผล : </label>
            <input value="<?=$row["answer"]?>" type="text" class="form-control" name="answer" id="answer" placeholder="answer">
           
        </div>
     
     
        <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" >
            <span class="glyphicon glyphicon-floppy-disk"></span>
            บันทึกข้อมูล
        </button>
        <a href="index.php" class="btn btn-default">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> หน้าหลัก
        </a>
        <a href="preview.php?id=<?=$Id?>" target="_blank" class="btn btn-default">Preview</a>
    </form>
    
    
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    
</html>