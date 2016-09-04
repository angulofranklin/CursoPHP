<?PHP
   header ("Content-type: image/png");
   $imagen = imagecreate (300, 300);

   $colorfondo = imagecolorallocate ($imagen, 203, 203, 203); // CCCCCC
   $color1 = imagecolorallocate ($imagen, 255, 0, 0); // FF0000
   $color2 = imagecolorallocate ($imagen, 0, 255, 0); // 00FF00
   $color3 = imagecolorallocate ($imagen, 0, 0, 255); // 0000FF

   imagefilledrectangle ($imagen, 0, 0, 300, 300, $colorfondo);
   imagefilledarc ($imagen, 150, 150, 200, 200, 0, 155, $color1, IMG_ARC_PIE);
   imagefilledarc ($imagen, 150, 150, 200, 200, 155, 315, $color2, IMG_ARC_PIE);
   imagefilledarc ($imagen, 150, 150, 200, 200, 315, 360, $color3, IMG_ARC_PIE);

   imagepng ($imagen);
   imagedestroy ($imagen);
?>
