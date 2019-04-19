<?php

$sendpost = isset($_POST['send'])?$_POST['send']:''; // ตรวจสอบว่ามีการ set ค่า ของ ตัวแปร POST หรือเปล่า
$bt=isset($_POST['bt'])?$_POST['bt']:'';  // เหมือนข้างบน
if($bt!=""){ // เช็คว่ามีค่าไหม ถ้ามีค่า แสดงว่า มันถูกคลิกมาอย่าง แน่นอน แล้ว ก็แสดงผลลัพท์ตามต้องการ
 echo"ค่าที่ส่งมา : <br>";
 echo $sendpost;
}
?>
<form name="frm" method="POST" action="">
<input type="text" name="send" /><br/>
<input type="submit" name="bt" value="ส่งข้อมูล"/>
</form>

