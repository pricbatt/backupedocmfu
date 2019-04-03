<?php
    require 'connection_database.php';
    $Id = $_GET["id"];

    if(isset($_POST["btnSubmit"])){
        $Firstname = $_POST["Firstname"];
        $Lastname = $_POST["Lastname"];
        $Signatue = $_POST["sign"];
        $Comment = $_POST["Comment"];
        $Approved = 0;
        $Filename = $_POST["Filename"];
        $toname = $_POST["toname"];
        if (isset($_POST['Approved'])) {
            $Approved = 1;
        }
        $sql = "UPDATE Student SET Firstname = '$Firstname', Lastname='$Lastname', 
                Signature = '$Signatue', 
                Comment='$Comment',
                Approved=$Approved,
                toname='$toname',
                Filename = '$Filename'
                WHERE Id = $Id ";
        $conn->query($sql);
    }

    $sql = "SELECT * FROM Student WHERE Id = $Id ";
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
            <label>ชื่อ</label>
            <input value="<?=$row["Firstname"]?>" type="text" class="form-control" name="Firstname" id="Firstname" placeholder="Firstname">
        </div>
        <div class="form-group">
            <label>นามสกุล</label>
            <input value="<?=$row["Lastname"]?>" type="text" class="form-control" name="Lastname" id="Lastname" placeholder="Lastname">
        </div>
        <div class="form-group">
            <label>เอกสาร</label>
            <input value="<?=$row["Filename"]?>" type="text" class="form-control" name="Filename" id="Filename" placeholder="Filename">
        </div>
        <div class="checkbox">
            <label>
                <input value="1" <?php if($row["Approved"]==1) { echo "checked='checked'"; } ?> type="checkbox" name="Approved" id="Approved"> อนุมัติ
            </label>
        </div>
        <div class="form-group">
            <label>มอบหมาย</label>
           
            <select class="form-control" name="toname">
            <option value="อาจารย์ ดร. วรศักดิ์ เรืองศิรรักษ์">อาจารย์ ดร. วรศักดิ์ เรืองศิรรักษ์</option>           
            </select>                                        
                                   
        </div>
        <div class="form-group">
            <label>ความเห็น</label>
            <input value="<?=$row["Comment"]?>" type="text" class="form-control" name="Comment" id="Comment" placeholder="Comment">
        </div>
        <canvas id="signature-pad" class="signature-pad" width="300px" height="200px"></canvas><br/>
        <textarea id='output'><?=$row["Signature"]?></textarea><br/>
        <input type="hidden" name="sign" id="sign">
        <button type='button' class="btn btn-default" id='click'>
            Preview
        </button> 
        <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit">
            <span class="glyphicon glyphicon-floppy-disk"></span>
            บันทึกข้อมูล
        </button>
        <a href="myindex.php" class="btn btn-default">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> หน้าหลัก
        </a>
        <a href="preview.php?id=<?=$Id?>" target="_blank" class="btn btn-default">PDF</a>
    </form>
    <img src='<?=$row["Signature"]?>' id='sign_prev' />
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