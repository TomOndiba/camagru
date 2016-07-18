<?php
  // header("Content-Type: image/png");
  include_once 'functions.php';

  $imgurl = $_POST['imgurl'];
  $frame = $_POST['frame'];

  // $im = imagecreatefrompng($imgurl);
  // $stamp = imageCreateFromPng('frames/'.$frame.'.png');
  $filteredData=substr($imgurl, strpos($imgurl, ",")+1);
  $unencodedData=base64_decode($filteredData);
  // file_put_contents("tmp/tobocheat.png", $unencodedData);
  $fp = fopen( "tmp/tibochite.png", 'wb' );
  fwrite( $fp, $unencodedData);
  fclose( $fp );
  
  //code works
  // $stamp = imageCreateFromPng('frames/'."violet".'.png');
  // imagepng($stamp, 'tmp/imagetest.png');
  //


  die;
// $encodedString = str_replace(' ','+', $imgurl);
// $decodedString = base64_decode($encodedString);
// file_put_contents('tmp/MyFile.png', $decodedString);

// $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgurl));
// file_put_contents('tmp/image.png', $data);
//   $encodedData = str_replace(' ','+',$imgurl);
// $decocedData = base64_decode($encodedData);
// file_put_contents('tmp/image.png', $decocedData);



  // die;
  // Définit les marges pour le cachet et récupère la hauteur et la largeur de celui-ci
  $marge_right = 10;
  $marge_bottom = 10;
  $sx = imagesx($stamp);
  $sy = imagesy($stamp);

  // Copie le cachet sur la photo en utilisant les marges et la largeur de la
  // photo originale  afin de calculer la position du cachet 
  imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

  // Affichage et libération de la mémoire
  header('Content-type: image/png');
  imagepng($im);
  imagedestroy($im);

?>