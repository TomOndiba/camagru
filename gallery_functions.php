<?php
  
  function get_pictures_paths($page, $bdd){
    $total_rows = get_total_pictures($bdd);
    // $last_pic = $total_rows - (9 * $page);
    // $first_pic = $last_pic - 8;

    // if ($last_pic < 0)
    //   $last_pic = 0;
    // if ($first_pic < 0)
    //   $first_pic = 0;
    if ($page == 0)
      $page = 0;
    else
      $page -=1;

    $first_image = 9 * $page;
    $query_string = "SELECT `id`, `user_id` FROM `picture` ORDER BY `id` DESC LIMIT ".$first_image." ,9";
    $query = $bdd->prepare($query_string);
    $query->execute();
    $result = $query->fetchAll();
    // print_r($result);
    echo "Lenght ->".count($result)."\n";
    echo "\nFirst ID ->".$result[0][0]."\n";
    echo "\nLast ID ->".$result[count($result) -1][0]."\n";
    // echo "\nLast Pic ->".$last_pic."\n";
    // echo "\nFirst Pic ->".$first_pic;
    // echo "\nQUERY ->".$query_string;
  }

  function get_total_pictures($bdd){
    $query = $bdd->prepare("SELECT COUNT(*) FROM `picture`");
    $query->execute();
    return(intval($query->fetch()[0]));
  }

?>