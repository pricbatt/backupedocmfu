<?php
    require 'connection_database.php';
    $Id = $_GET["id"];

    if(isset($_POST["btnSubmit"])){
        
        
      
       
        $stamp = $_POST["stamp"];
        // $Approved = 0;
        
       
        // if (isset($_POST['Approved'])) {
        //     $Approved = 1;
        // }
        $sql = "UPDATE form SET
                stamp='$stamp'
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
    <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> รายละเอียด</h1><hr>
    
        <form method="post" action="detail.php?id=<?=$Id?>">
        <div class="form-group">
            <label>ชื่อผู้สร้างเอกสาร : </label>
            <label><?=$row["Firstname"]?></label>
           
        </div>
        <div class="form-group">
            <label>ผู้รับผิดชอบ : </label>
            <label><?=$row["toname"]?></label>
           
        </div>
        <div class="form-group">
            <label>บันทึกข้อความ : </label>           
            <a href="preview.php?id=<?=$row["Id"]?>" target="_blank" >รายละเอียด</a>
        </div>
        <div class="form-group">
            <label>เอกสารแนบ : </label>
            <a href="doc/<?php echo $row["file"]; ?>" target="_blank" class="btn btn-primary">รายละเอียด</a>
        </div>
        <!-- <div class="checkbox">
            <label>
                <input value="1" <?php if($row["Approved"]==1) { echo "checked='checked'"; } ?> type="checkbox" name="Approved" id="Approved"> อนุมัติ
                
            </label>
            <label> <input value="2" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> type="checkbox" name="Approved" id="Approved"> ไม่อนุมัติ</label>
          
        </div> -->

        <div class="form-group">
        <label>ตำแหน่งที่ประทับตรา</label>
     
            
     <select class="form-control" name="stamp">
     <option value=""><-- ตำแหน่งที่ประทับตรา --></option>
     <option value="1">ขวาล่าง</option>
     <option value="2">ซ้ายล่าง</option>
     
   </select>
 
        </div>
        <div class="form-group">
            <label>การตอบรับ : </label>
            <?php
                                if($row["Approved"] == '0') {
                                     echo "<label>อยู่ระหว่างดำเนินการ</label>";}

                                elseif($row["Approved"] == '1'){

                                    echo "<label>เกษียนเอกสารแล้ว</label>";}
                                elseif($row["Approved"] == '2'){

                                    echo "<label>ไม่อนุมัติ</label>";}
                                elseif($row["Approved"] == '3'){

                                    echo "<label>รับทราบ</label>";}
                                else{

                                        echo "<label>ไม่สามารถดำเนินการได้</label>";
           
}
                     ?>
           
           
        </div>
      
        <div class="form-group">
            <label>เหตุผล : </label>
            <label><?=$row["answer"]?></label>
         
           
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