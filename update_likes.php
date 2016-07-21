<?php
  include 'functions.php';
  include 'gallery_functions.php';

  function get_likes_string($likes){
    $likes_string = '';
    foreach ($likes as $key) {
      $likes_string = $likes_string.$key.',';
    }
    return trim($likes_string, ',');
  }

  $img_uid = $_POST['img_uid'];
  $user_id = $_POST['user_id'];

  $likes = list_likes($img_uid, $bdd);

  if (in_array(strval($user_id), $likes, true)){
    $array_pos = array_search(strval($user_id), $likes);
    unset($likes[$array_pos]);
  }
  else
    array_push($likes, strval($user_id));

  $likes_string = get_likes_string($likes);
  $request = "UPDATE picture SET likes='".$likes_string. "' WHERE uid='".$img_uid.'\'';
  $query = $bdd->prepare($request);
  $query->execute();
  echo get_likes($img_uid, $bdd);


?>
