<?php
  include_once 'functions.php';

  function create_folders($username){

    if (!file_exists('pictures'))
      mkdir('pictures');

    if (!file_exists('pictures/'.$username))
      mkdir('pictures/'.$username);
  }

  function save_tmp_pic($uid, $pic_url, $username, $unencodedData){
    $fp = fopen($pic_url, 'wb');
    fwrite($fp, $unencodedData);
    fclose($fp);
  }

  function insert_picture_into_db($uid, $username, $bdd){
    $user_id = return_id($username, $bdd);

    $req = $bdd->prepare('INSERT INTO picture(user_id, uid, likes, comments) VALUES(:user_id, :uid, :likes, :comments)');

    $req->execute(array(
      'user_id' => $user_id,
      'uid' => $uid,
      'likes' => '',
      'comments' => ''
      ));
  }


?>