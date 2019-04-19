<?php
// $param = $_GET["image"];
    
$fname = "1.jpg"; // replace with your path
$size = getimagesize($fname);
header('Content-type: '.$size['mime']);
readfile($fname);
?>