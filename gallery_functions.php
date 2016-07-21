<?php
  
  function get_pictures_paths($page, $bdd){
    if ($page != 0)
      $page -= 1;
    elseif ($page < 0) {
      $page = 0;
    }

    $first_image = 9 * $page;
    $query_string = "SELECT `uid`, `user_id` FROM `picture` ORDER BY `id` DESC LIMIT ".$first_image." ,9";
    $query = $bdd->prepare($query_string);
    $query->execute();
    $result = $query->fetchAll();

    return final_path($result, $bdd);
  }

  function final_path($result, $bdd){
    $tab = [];
    $i = 0;
    foreach ($result as $key) {
      $username = find_username($key['user_id'], $bdd);
      $tab[$i] = "pictures/".$username.'/'.$key['uid'].'.png';
      $i++;
    }
    return $tab;
  }

  function get_total_pictures($bdd){
    $query = $bdd->prepare("SELECT COUNT(*) FROM `picture`");
    $query->execute();
    return(intval($query->fetch()[0]));
  }

?>