<?php

session_start();
$_SESSION['kod'] = null;
//echo "Kod sesije je: " . $_SESSION['kod'];
if(!isset($_SESSION['kod']))
{
     
  $_SESSION['kod'] = rand(100000,999999);   
}

header("Content-type: image/png");
$image = imagecreate(100,50);
$line_color = imagecolorallocate($image, 64,64,64); 


$bela = imagecolorallocate($image, 255,255,255);
$crna = imagecolorallocate($image, 0,0,0);


$line_color = imagecolorallocate($image, 0,0,0); 
for($i=0;$i<10;$i++) {
    imageline($image,0,rand()%50,100,rand()%50,$line_color);
}

$pixel_color = imagecolorallocate($image, 0,0,255);
for($i=0;$i<1000;$i++) {
    imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
}  


imagestring($image, 8 , 10 ,10,$_SESSION['kod'] , $crna);
imagepng($image);

