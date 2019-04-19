<?php 
if (!file_exists('C:/output_pdf')) {
  mkdir('C:/output_pdf', 0777, true);
}
// $pdfAbsolutePath = __DIR__."/output_short.pdf";
$pdfAbsolutePath = "C:/output_pdf/output_short.pdf";
if (move_uploaded_file($_FILES['templateDoc']["tmp_name"], $pdfAbsolutePath)) {

  $img = new \Imagick();
  $img->setResolution(300, 300);
  $img->readImage($_SERVER['DOCUMENT_ROOT'] . '/test/index.pdf');
  $num_pages = $img->getNumberImages();
  $img->setImageCompressionQuality(100);
 
      $folder = "C:/exportPDF/".rand();
    
      if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }
   
  for ($i = 0; $i < $num_pages; $i++) {
      $img->setIteratorIndex($i);
      $img->setImageFormat('jpeg');
     
  $img->writeImage($folder."/".($i+1).'.jpg');
      // $img->writeImage(__DIR__."/save/img/".($i+1).'-'.rand().'.jpg');
  }
  
  $img->destroy();

echo "<script>
alert('All pages of PDF is converted to images');
window.history.go(-2);
</script>";
}else{
  echo "PDF doesn't have any pages";
  header('Location: index.php');

}

?> 
