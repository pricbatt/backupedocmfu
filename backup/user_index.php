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
<?php
    require 'connection_database.php';
    $sql = "SELECT * FROM form where Firstname = '".$objResult["name"]."'  or Approved = '1' AND toname  = '".$objResult["name"]."' or Approved = '3' AND toname  = '".$objResult["name"]."' ORDER BY id DESC ";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <!-- Bootstrap -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>  
</head>
<body>
<div class="row">
<div class="container">
        <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> เอกสารรอการจ่ายงานนะจ๊ะ</h1><?php echo $objResult["name"];?> : <a href="logout.php"> Logout</a><hr>
        <div><a href="add.php" class="btn btn-danger"><span class="glyphicon glyphicon-save-file"></span>
        เพิ่มข้อมูลใหม่</a></div><br>
<table id="dtBasicExample" class="table table-striped table-bordered" style="width:100%">
        <colgroup>
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-4">
                    <col class="col-xs-2">
        </colgroup>
        <thead> 
                    <tr> 
                        <th>ลำดับ</th>
                        <th>เลขที่เอกสาร</th>
                        <th>เรื่อง</th>
                        <th>โดย</th>
                        <th>ชื่อผู้รับผิดชอบ</th>
                        <th>วันที่</th>
                        <th>สถานะ</th>
                        <th style="text-align: center;">รายละเอียด
                            <!-- <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> เพิ่มข้อมูลใหม่</button> -->
                        </th>
                        <th>เกษียน</th>
                        <th>เอกสารแนบ</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $index = 1;
                        while($row = $result->fetch_assoc())
                        { 
                    ?>
                    <tr>
                        <td><?=$index?></td>
                        <td><?=$row["docname"]?></td>
                        <td><?=$row["topic"]?></td>
                        <td><?=$row["Firstname"]?></td>
                        <td><?=$row["toname"]?></td>
                        <th><?=$row["created"]?></th>
                        <?php
                                if($row["Approved"] == '0') {
                                     echo "<td><center>อยู่ระหว่างดำเนินการ</center></td>";}

                                elseif($row["Approved"] == '1'){

                                    echo "<td><center><a>เกษียนเอกสารแล้ว</a></center></td>";}
                                elseif($row["Approved"] == '2'){

                                    echo "<td><center><a>ไม่อนุมัติ</a></center></td>";}
                                elseif($row["Approved"] == '3'){

                                    echo "<td><center><a>รับทราบ</a></center></td>";}
                                else{

                                        echo "<td><center><a>ไม่สามารถดำเนินการได้</a></center></td>";
           
}
                     ?>
                      
                        <td style="text-align: center;">
                            <a href="edit_user.php?id=<?=$row["Id"]?>" class="btn btn-success">
                                <span class="glyphicon glyphicon-book" aria-hidden="true"></span> รายละเอียด
                            </a>
                            <!-- <a onclick="return confirm('คุณต้องการลบข้อมูล <?=$row["Firstname"]?> <?=$row["Lastname"]?> ใช่หรือไม่?');" href="index.php?id=<?=$row["Id"]?>&mode=delete" class="btn btn-danger">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบข้อมูล
                            </a> -->
                        </td>
                        
                        <td><a href="preview.php?id=<?=$row["Id"]?>" target="_blank" class="btn btn-primary">เกษียน</a></td>
                        <td  style="text-align: center;">
                        <a href="doc/<?php echo $row["file"]; ?>" target="_blank" class="btn btn-primary">
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span> เอกสารแนบ
                        </a>
                        </td>
                        <td><a href="delete.php?id=<?=$row["Id"]?>" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');" class='btn btn-danger' role='button'">ลบ</a></td>
                    </tr>
                    <?php
                        $index++; 
                        } 
                    ?>
                </tbody>
            </table>
    </div>
 </div>
 
          <script>
// Basic example
$(document).ready(function () {
$('#dtBasicExample').DataTable({
"searching": true // false to disable search (or any other option)
});
$('.dataTables_length').addClass('bs-select');
});
    </script>

</body>
</html>