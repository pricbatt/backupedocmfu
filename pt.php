
<?php
ini_set('display_errors', 'On');
require 'connection_database.php';
$Id = $_GET["id"];
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/temps',
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'thsarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
        ]
    ],
    'default_font' => 'thsarabun'
]);
ob_start();
$sql = "SELECT * FROM form WHERE Id = $Id ";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.container {
  position: relative;
  text-align: center;
  color: #000;
  background: url(<?=$_GET["file"]?>) no-repeat;
background-size: 100%;
height:100%;
padding-top:0px;

}


.top-right {
   padding-top:5px;
  padding-left:500px;
  

}

/* .bottom-right {
    position: absolute;
    padding-top:600px;
    padding-left:500px;
} */


</style>
</head>
<body>


<div class="container">
  <!-- <img src="documents/MFU-1.jpg" alt="Snow" style="width:100%;"> -->

 
  <div class="top-right"><p>สำนักวิชาเทคโนโลยีสารสนเทศ<br>เลขที่รับหนังสือ : <?=$row["docname"]?> <br>วันที่ : <?=$row["created"]?></p></div>

        <?php if($_GET["stamp"] == '1') : ?>
        <div class="bottom-right" style="position: absolute;padding-top:630px;padding-left:500px;background-color:transparent;">
            <p style="background-color:transparent;">คำสั่ง / ความเห็น <br>
            <input type="checkbox" <?php if($row["Approved"]==1 || $row["Approved"]==3 || $row["Approved"]==4) { echo "checked='checked'"; } ?> > อนุมัติ
            <input type="checkbox" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> > ไม่อนุมัติ <br>
            ผู้รับผิดชอบ <br>
            <?=$row["toname"]?> <br>
            <?=$row["Comment"]?> <br>
            <img src="<?=$row["Signature"]?>" width="150" alt=""> <br>
            (<?=$row["Firstname"]?> <?=$row["Lastname"]?>)
            </p></div>
        
        </div>
        <?php elseif($_GET["stamp"] == '2') : ?>
        <div class="bottom-right" style="padding-top:630px;padding-left:-600px;background-color:transparent;">
            <p style="background-color:transparent;">คำสั่ง / ความเห็น <br>
            <input type="checkbox" <?php if($row["Approved"]==1 || $row["Approved"]==3 || $row["Approved"]==4) { echo "checked='checked'"; } ?> > อนุมัติ
            <input type="checkbox" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> > ไม่อนุมัติ <br>
            ผู้รับผิดชอบ <br>
            <?=$row["toname"]?> <br>
            <?=$row["Comment"]?> <br>
            <img src="<?=$row["Signature"]?>" width="150" alt=""> <br>
            (<?=$row["Firstname"]?> <?=$row["Lastname"]?>)
            </p></div>
        <!-- <?php else : ?>
        <div class="bottom-right" style="position: absolute;padding-top:600px;padding-left:500px;">
            <p style="background-color:white;">คำสั่ง / ความเห็น <br>
            <input type="checkbox" <?php if($row["Approved"]==1 || $row["Approved"]==3 || $row["Approved"]==4) { echo "checked='checked'"; } ?> > อนุมัติ
            <input type="checkbox" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> > ไม่อนุมัติ <br>
            ผู้รับผิดชอบ <br>
            <?=$row["toname"]?> <br>
            <?=$row["Comment"]?> <br>
            <img src="<?=$row["Signature"]?>" width="150" alt=""> <br>
            (<?=$row["Firstname"]?> <?=$row["Lastname"]?>)
            </p></div> -->
        <?php endif; ?>
   

  <!-- <div class="bottom-right" style="position: absolute;padding-top:600px;padding-left:500px;">
      <p style="background-color:white;">คำสั่ง / ความเห็น <br>
      <input type="checkbox" <?php if($row["Approved"]==1 || $row["Approved"]==3 || $row["Approved"]==4) { echo "checked='checked'"; } ?> > อนุมัติ
    <input type="checkbox" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> > ไม่อนุมัติ <br>
    ผู้รับผิดชอบ <br>
    <?=$row["toname"]?> <br>
    <?=$row["Comment"]?> <br>
    <img src="<?=$row["Signature"]?>" width="150" alt=""> <br>
    (<?=$row["Firstname"]?> <?=$row["Lastname"]?>)
    </p></div>
  
</div> -->

</body>
</html> 

<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($html);
$mpdf->Output();
?>
