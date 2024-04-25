<?php 
  
$file = $_GET["cart_id"] .".pdf"; 
  
header('Content-Type: application/pdf'); 
  
header('Content-Disposition: attachment; filename="gfgpdf.pdf"'); 
  
$imagpdf = file_put_contents($image, file_get_contents($file));  
  
echo $imagepdf; 
?>