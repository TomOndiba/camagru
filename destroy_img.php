<?php

	include 'functions.php';

	$img_uid = $_POST['img_uid'];
	$user_id = $_POST['user_id'];
	$request = "DELETE FROM picture WHERE uid = '".$img_uid."';";
  $img_path = 'pictures/'.find_username($user_id, $bdd).'/'.$img_uid.'.png';

  $query = $bdd->prepare($request);
  $query->execute();
  unlink($img_path);


?>