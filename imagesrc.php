<?php
  include_once 'frame_merge.php';

  //getting image url and frame name from ajax request
  $imgurl = $_POST['imgurl'];
  $frame = $_POST['frame'];
  $username = $_POST["username"];

  //correcting ajax syntax
  $imgurl = str_replace(" ", '+', $imgurl);
  //removing beginning of string
  $filteredData=substr($imgurl, strpos($imgurl, ",")+1);

  $unencodedData= base64_decode($filteredData);

  create_folders($username);
  $uid = uniqid();
  $pic_url = 'pictures/'.$username.'/'.$uid.'.png';
  save_tmp_pic($uid, $pic_url, $username, $unencodedData);


  //using gd to merge image and frame
  $src_im = imagecreatefrompng('frames/'.$frame.'.png');
  $dst_im = imagecreatefrompng($pic_url);

  //dealing with transparency issue
  $background = imagecolorallocate($src_im, 0, 0, 0);
  imagecolortransparent($src_im, $background);
  imagealphablending($src_im, false);
  imagesavealpha($src_im, true);

  $background = imagecolorallocate($dst_im, 0, 0, 0);
  imagecolortransparent($dst_im, $background);
  imagealphablending($dst_im, false);
  imagesavealpha($dst_im, true);

  $dst_x = 0;
  $dst_y = 0;
  $src_x = 0;
  $src_y = 0;
  $src_w = 620;
  $src_h = 620;

  imagecopymerge($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, 100);


  //Output the correct header to the browser
  header('Content-Type: image/png');

  //Save the image
  imagepng($dst_im, $pic_url);

  imagedestroy($src_im);
  imagedestroy($dst_im);

  insert_picture_into_db($uid, $username, $bdd);

?>
