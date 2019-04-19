<?php

// $img = new \Imagick();
// $img->setResolution(300, 300);
// $img->readImage($_SERVER['DOCUMENT_ROOT'] . '/test/index.pdf');
// $num_pages = $img->getNumberImages();
// $img->setImageCompressionQuality(100);

// for ($i = 0; $i < $num_pages; $i++) {
//     $img->setIteratorIndex($i);
//     $img->setImageFormat('jpeg');
//     $img->writeImage(__DIR__."/save/img/".($i+1).'-'.rand().'.jpg');
// }

// $img->destroy();
?>

<?php  
$allowed_types=array('jpg','jpeg','gif','png');  
$dir    ="banner/";  
    
$files1 = scandir($dir); 

foreach($files1 as $key=>$value){  
    if($key>1){  
        $file_parts = explode('.',$value);  
        $ext = strtolower(array_pop($file_parts));  
        if(in_array($ext,$allowed_types)){  
            echo "<img style='width:20%;' src='".$dir.$value."'>&nbsp;";     
     
            echo $dir.$value;
        }  
  
    }  
}  

 ?>
