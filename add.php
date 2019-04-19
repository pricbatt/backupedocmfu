
<?php
   date_default_timezone_set('Asia/Bangkok');
  
?>
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

//  if (!file_exists(__DIR__."/output_pdf")) {
//   mkdir(__DIR__."/output_pdf", 0777, true);
// }
// // $pdfAbsolutePath = __DIR__."/output_short.pdf";
// $pdfAbsolutePath = __DIR__."/output_pdf"."/".rand()."output_short.pdf";

if (move_uploaded_file($_FILES["templateDoc"]["tmp_name"],"documents/".$_FILES["templateDoc"]["name"])) {
    
   
  $img = new \Imagick();
  $img->setResolution(300, 300);
  $img->readImage(__DIR__."/"."documents/".$_FILES["templateDoc"]["name"]);
  $num_pages = $img->getNumberImages();
  $img->setImageCompressionQuality(100);    
 
  $folder = "exportPDF/".rand();
    
      if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }
   
  for ($i = 0; $i < $num_pages; $i++) {
      $img->setIteratorIndex($i);
      $img->setImageFormat('jpeg');
     
      $img->writeImage(__DIR__."/".$folder."/".($i+1).'-'.time().'.jpg');
      // $img->writeImage(__DIR__."/save/img/".($i+1).'-'.rand().'.jpg');
  }
  
  $img->destroy();

echo "<script>
alert('Please Insert More Information');

</script>";








?>
<?php

move_uploaded_file($_FILES["templateDoc"]["tmp_name"],"documents/".$_FILES["templateDoc"]["name"]);

require 'connection_database.php';         

        $pdf=trim($_FILES["templateDoc"]["name"]);
    



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO form (Filename) VALUES ('{$pdf}')";

if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);    
    // echo "New record created successfully. Last inserted ID is: " . $last_id;
    

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?>
<?php
require 'connection_database.php';  
$sql2 = "SELECT * FROM form WHERE Id = $last_id ";
$result2 = $conn->query($sql2);
$row2 = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เพิ่มเอกสาร</title>
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

    .modal {
z-index:1;
display:none;
padding-top:10px;
position:fixed;
left:0;
top:0;
width:100%;
height:100%;
overflow:auto;
background-color:rgb(0,0,0);
background-color:rgba(0,0,0,0.8)
}

.modal-content{
margin: auto;
display: block;
    position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.modal-hover-opacity {
opacity:1;
filter:alpha(opacity=100);
-webkit-backface-visibility:hidden
}

.modal-hover-opacity:hover {
opacity:0.60;
filter:alpha(opacity=60);
-webkit-backface-visibility:hidden
}


.close {
text-decoration:none;float:right;font-size:5%;font-weight:bold;color:white
}
.container1 {
width:200px;
display:inline-block;
}
.modal-content, #caption {   
  
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}


@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}
    </style>
</head>
<body>
    <div class="container">
    <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> เพิ่มเอกสาร</h1>
    <?php echo $objResult["name"];?><hr>

                   


    <form id="new_topic" name="new_topic" method="post" action="saveadd.php" enctype="multipart/form-data">
    
        <div class="form-group">
            <label>ชื่อ - สกุล</label>
            <input value="อาจารย์ ดร.ธีรวิศิฏฐ์ เลาหะเพ็ญแสง" type="text" class="form-control" name="Firstname" id="Firstname" placeholder="อาจารย์ ดร.ธีรวิศิฏฐ์ เลาหะเพ็ญแสง" readonly>
        </div>
 
        <div class="form-group">
            <label>เลขหนังสือ</label>
            <input  type="text" class="form-control" name="docname" id="docname" placeholder="เลขหนังสือ">
        </div>
        <div class="form-group">
            <label>ชนิดหนังสือ</label>
            <!-- test -->
            
            <select class="form-control" name="type">
			<option value=""><-- ชนิดของหนังสือ --></option>
			<option value="บันทึกข้อความ">บันทึกข้อความ</option>
		  </select>
            <!-- test -->
            <!-- <select class="form-control" name="toname">
            <option value="อาจารย์ ดร. วรศักดิ์ เรืองศิรรักษ์">อาจารย์ ดร. วรศักดิ์ เรืองศิรรักษ์</option>           
            </select>                                         -->
                                   
        </div>
        <div class="form-group">
            <label>เรื่อง</label>
            <input  type="text" class="form-control" name="topic" id="topic" placeholder="เรื่อง">
        </div>
        <div class="form-group">
            <label>หน้าที่ต้องลงตราประทับ : </label>
            <!-- บันทึกข้อวคาม -->
            <?php

$allowed_types=array('jpg','jpeg','gif','png');  
$dir    =$folder."/";  
    
$files1 = scandir($dir); 

foreach($files1 as $key=>$value){  
    if($key>1){  
        $file_parts = explode('.',$value);  
        $ext = strtolower(array_pop($file_parts));  
        if(in_array($ext,$allowed_types)){  
            // echo "<img style='width:20%;' src='".$dir.$value."'>&nbsp;";     ?>
          
            <!-- <input type="radio" name="test" value="small" checked> -->
           
            <?php 
            // echo $value; 
            ?>
           <div class="container1">
           
           <input type="radio" name= "file" value="<?php echo $value; ?>" checked>
           <?php echo "<img style='width:50%;' src='".$dir.$value."' alt='animate' class='image' onclick='onClick(this)' class='modal-hover-opacity'>&nbsp;"; ?>
  </div>

  <div id="modal01" class="modal" onclick="this.style.display='none'">
  <span class="close">&times;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  <div class="modal-content">
    <img id="img01" style="max-width:70%">
  </div>
</div>
           
            <?php
     
           
        }  
  
    }  
}  
    ?>            
        </div>
      
        <div class="form-group">
            <label>เอกสารทั้งหมด : </label>
                       
            
            <a href="documents/<?=$row2["Filename"]?>" target="_blank"><?=$row2["Filename"]?></a>
          
        </div>
        <div class="form-group">
            <label>ตำแหน่งที่ประทับตรา</label>
     
            
            <select class="form-control" name="stamp">
			<option value=""><-- ตำแหน่งที่ประทับตรา --></option>
			<option value="1">ขวาล่าง</option>
            <option value="2">ซ้ายล่าง</option>
            
		  </select><br>
          <a href="" class="btn btn-primary" id="Submit2" name="Submit2">
            <span class="glyphicon glyphicon-floppy-disk"></span>
            Preview
        </a>
        </div>
        <textarea style="display:none;"type="hidden" name="id" cols="50" rows="5 placeholder="Enter ..."><?php echo $objResult['UserID'];?></textarea></td>      
        
        <textarea style="display:none;"type="hidden" name="lastid" cols="50" rows="5 placeholder="Enter ..."><?php echo $last_id;?></textarea></td>    
        <textarea style="display:none;"type="hidden" name="folder" cols="50" rows="5 placeholder="Enter ..."><?php echo $dir; ?></textarea></td>    
        
    
        <button type="submit" class="btn btn-primary" id="Submit" name="Submit">
            <span class="glyphicon glyphicon-floppy-disk"></span>
            บันทึกข้อมูล
        </button>

        <!-- <input type="submit" name="Submit" value="บันทึกข้อมูล" class='glyphicon glyphicon-floppy-disk'> -->
            
        <a href="index.php" class="btn btn-default">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> หน้าหลัก
        </a>
      
      
    </form>
    
    </div>
    <script>
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
}
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    <script>
    $('#Submit2').click(function(e){
        var position = $('select[name=stamp]').val()
        var file=    $('input[name=file]:checked').next().attr('src') 
        window.open('pt.php?stamp='+ position+'&file='+file ,'_blank')
        event.preventDefault();
        handleFireButton();

    })
    </script>

</body>
</html>


   


<?php  



 
}else{
    
  echo "PDF doesn't have any pages";
  header('Location: index.php');

}


?> 


