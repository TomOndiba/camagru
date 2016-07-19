<?php

  //getting image url and frame name from ajax request
  $imgurl = $_POST['imgurl'];
  $frame = $_POST['frame'];

  //correcting ajax syntax
  $imgurl = str_replace(" ", '+', $imgurl);
  //removing beginning of string
  $filteredData=substr($imgurl, strpos($imgurl, ",")+1);

  $unencodedData= base64_decode($filteredData);

  //saving as temporary picture
  $fp = fopen( 'tmp/tmp.png', 'wb' );
  fwrite( $fp, $unencodedData);
  fclose( $fp );

  //using gd to merge image and frame
  $src_im = imagecreatefrompng('frames/'.$frame.'.png');
  $dst_im = imagecreatefrompng('tmp/tmp.png');

  //dealing with transparency issue
  $background = imagecolorallocate($src_im, 0, 0, 0);
  imagecolortransparent($src_im, $background);
  imagealphablending($src_im, false);
  imagesavealpha($src_im, true);

  $dst_x = 0;
  $dst_y = 0;
  $src_x = 0;
  $src_y = 0;
  $src_w = 620;
  $src_h = 620;

  $rep = imagecopymerge($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, 100);


  //Output the correct header to the browser
  header('Content-Type: image/png');

  //Path to save the image too
  $path = 'tmp/new.png';
  //Save the image
  imagepng($dst_im, $path);

  imagedestroy($src_im);
  imagedestroy($dst_im);

?>
