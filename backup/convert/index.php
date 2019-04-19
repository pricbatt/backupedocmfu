<html>
้<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/login1.css">
</head>
  <body>
 <div>ไฟล์จะไปอยู่ที่ ไดร์ C โฟล์เดอร์ exportPDF</div><br>
    <form action="ConvertPdfToImg.php" enctype="multipart/form-data" method="post" name="f1">

     <div> <input id="templateDoc" name="templateDoc" type="file" class="btn btn-success"></div><br>

      <!-- <input type="submit" /> -->
      <!-- <button type="submit" class="btn btn-primary" id="Submit" name="Submit">แปลงไฟล์</button>
      <a href="javascript:history.back()" class="btn btn-danger">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> หน้าหลัก
        </a> -->
             <button type="submit" class="btn btn-primary" id="Submit" name="Submit">แปลงไฟล์</button>
      <a href="http://localhost/mfuworkshop/" class="btn btn-danger">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> หน้าหลัก
        </a>
    </form>
    
  </body>

</html>