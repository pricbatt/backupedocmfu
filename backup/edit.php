<?php
    require 'connection_database.php';
    $Id = $_GET["id"];

    if(isset($_POST["btnSubmit"])){
        $Firstname = $_POST["Firstname"];
        
        $Signatue = $_POST["sign"];
        $Comment = $_POST["Comment"];
        $Approved = $_POST['Approved'];
        // $Approved = 0;
        $Filename = $_POST["Filename"];
        $toname = $_POST["toname"];
        // if (isset($_POST['Approved'])) {
        //     $Approved = 1;
        // }
        $sql = "UPDATE form SET Firstname = '$Firstname', 
                Signature = '$Signatue', 
                Comment='$Comment',
                Approved='$Approved',
                toname='$toname',
                Filename = '$Filename'
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
    <form method="post" action="edit.php?id=<?=$Id?>">
        <div class="form-group">
            <label>ชื่อ - สกุล</label>
            <input value="<?=$row["Firstname"]?>" type="text" class="form-control" name="Firstname" id="Firstname" placeholder="Firstname" readonly>
        </div>
  
        <div class="form-group">
            <label>บันทึกข้อความ</label>
            <input value="<?=$row["Filename"]?>" type="hidden" class="form-control" name="Filename" id="Filename" placeholder="Filename">
            <a href="documents/<?php echo $row["Filename"]; ?>" target="_blank"><?php echo $row["Filename"];?></a>
        </div>
        <div class="form-group">
            <label>เอกสารแนบ</label>
            <input value="<?=$row["file"]?>" type="hidden" class="form-control" name="file" id="file" placeholder="file">
            <a href="doc/<?php echo $row["file"]; ?>" target="_blank"><?php echo $row["file"];?></a>
        </div>
        <!-- <div class="checkbox">
            <label>
                <input value="1" <?php if($row["Approved"]==1) { echo "checked='checked'"; } ?> type="checkbox" name="Approved" id="Approved"> อนุมัติ
                
            </label>
            <label> <input value="2" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> type="checkbox" name="Approved" id="Approved"> ไม่อนุมัติ</label>
          
        </div> -->
        <div class="selectbox">
            <label>การอนุมัติ : </label>
                <select name="Approved" id="Approved" require>
                <option value="">Select</option>                
                <option value="1">อนุมัติ</option>
                <option value="2">ไม่อนุมัติ</option>           
                </select>
        </div>
        <div class="form-group">
            <label>มอบหมาย</label>
            <!-- test -->
            
            <select class="form-control" name="toname">
			<option value=""><-- รายชื่อ --></option>
			<?php
            require 'connection_database.php';
			$strSQL = "SELECT * FROM member ORDER BY UserID ASC";
			$objQuery = mysqli_query($conn,$strSQL);
			while($objResuut = mysqli_fetch_array($objQuery))
			{
			?>
			<option value="<?php echo $objResuut["name"];?>"><?php echo $objResuut["name"];?></option>
			<?php
			}
			?>
		  </select>
            <!-- test -->
            <!-- <select class="form-control" name="toname">
            <option value="อาจารย์ ดร. วรศักดิ์ เรืองศิรรักษ์">อาจารย์ ดร. วรศักดิ์ เรืองศิรรักษ์</option>           
            </select>                                         -->
                                   
        </div>
        <div class="form-group">
            <label>ความเห็น</label>
            <input value="<?=$row["Comment"]?>" type="text" class="form-control" name="Comment" id="Comment" placeholder="Comment">
           
        </div>
        <canvas id="signature-pad" class="signature-pad" width="300px" height="200px"></canvas><br/>
        
        <input type="hidden" name="sign" id="sign">
     
        <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit" >
            <span class="glyphicon glyphicon-floppy-disk"></span>
            บันทึกข้อมูล
        </button>
        <a href="index.php" class="btn btn-default">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> หน้าหลัก
        </a>
        <a href="preview.php?id=<?=$Id?>" target="_blank" class="btn btn-default">Preview</a>
    </form>
    <div class="form-group">
            <label>ลายเซ็นต์ : </label>
            <img src='<?=$row["Signature"]?>' id='sign_prev' />
        </div>
    
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    <script>
    $(document).ready(function() {
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
        $('#click').click(function(){
            var data = signaturePad.toDataURL('image/png');
            $('#output').val(data);
            $('#sign').val(data);

            $("#sign_prev").show();
            $("#sign_prev").attr("src",data);
            // Open image in the browser
            //window.open(data);
        });

        $('#btnSubmit').click(function(){
            var data = signaturePad.toDataURL('image/png');
            //$('#output').val(data);
            $('#sign').val(data);

            //$("#sign_prev").show();
            //$("#sign_prev").attr("src",data);
            // Open image in the browser
            //window.open(data);
        });
    });
    </script>
</body>
</html>