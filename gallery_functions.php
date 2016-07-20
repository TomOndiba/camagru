<?php
  
  function get_pictures_paths($page, $bdd){
    $total_rows = get_total_pictures($bdd);
    $last_pic = $total_rows - (9 * $page);
    $first_pic = $last_pic - 8;

    if ($last_pic < 0)
      $last_pic = 0;
    if ($first_pic < 0)
      $first_pic = 0;

    $query = $bdd->prepare("SELECT `id` FROM `picture` ORDER BY `id` DESC LIMIT 9, ".$first_pic);
    // $query = $bdd->prepare("SELECT `id` FROM `picture` LIMIT 9, '$first_pic' ");
    $query->execute();
    $result = $query->fetch();
    print_r($result);

    // for ($i = $first_pic; $i <= $last_pic ; $i++) { 
    //   $query = $bdd->prepare("SELECT * FROM `picture` WHERE `id` = '$i' ");
    //   $query->execute();
    //   $result = intval($query->fetch()[0]);
    // }

  }

  function get_total_pictures($bdd){
    $query = $bdd->prepare("SELECT COUNT(*) FROM `picture`");
    $query->execute();
    return(intval($query->fetch()[0]));
  }

?>