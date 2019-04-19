<?php
require 'connection_database.php';
$Id = $_GET["id"];
$sql = "SELECT * FROM form WHERE Id = $Id ";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.container {
  position: relative;
  text-align: center;
  color: #000;
}


.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
  
}


</style>
</head>
<body>


<div class="container">
  <img src="documents/MFU-1.jpg" alt="Snow" style="width:100%;">

 
  <div class="top-right"><p>สำนักวิชาเทคโนโลยีสารสนเทศ<br>เลขที่รับหนังสือ : <?=$row["docname"]?> <br>วันที่ : <?=$row["created"]?></p></div>

  <div class="bottom-right">
      <p>คำสั่ง / ความเห็น <br>
      <input type="checkbox" <?php if($row["Approved"]==1 || $row["Approved"]==3 || $row["Approved"]==4) { echo "checked='checked'"; } ?> > อนุมัติ
    <input type="checkbox" <?php if($row["Approved"]==2) { echo "checked='checked'"; } ?> > ไม่อนุมัติ <br>
    ผู้รับผิดชอบ <br>
    <?=$row["toname"]?> <br>
    <?=$row["Comment"]?> <br>
    <img src="<?=$row["Signature"]?>" width="150" alt=""> <br>
    (<?=$row["Firstname"]?> <?=$row["Lastname"]?>)
    </p></div>
  
</div>

</body>
</html> 
