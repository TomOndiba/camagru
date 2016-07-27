<?php
  
  function get_pictures_paths($page, $bdd){
    $page = intval($page);

    if ($page < 0)
      $page = 0;
    elseif ($page != 0)
      $page -= 1;

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

  function get_likes($img_uid, $bdd){
    $likes = list_likes($img_uid, $bdd);
    if (empty($likes[0]))
      return 0;

    return count($likes);
  }

  function list_likes($img_uid, $bdd){
    $query = $bdd->prepare("SELECT * FROM `picture` WHERE `uid` = ?");
    $query->execute(array(
      $img_uid));

    $result = $query->fetch();

    if (empty($result))
      return(0);

    $likes_row = $result['likes'];
    return explode(',', $likes_row);
  }

  function get_total_pictures($bdd){
    $query = $bdd->prepare("SELECT COUNT(*) FROM `picture`");
    $query->execute();
    return(intval($query->fetch()[0]));
  }

  function get_comments($img_uid, $bdd){
    $query = $bdd->prepare("SELECT * FROM `comment` WHERE `picture_uid` = ?");
    $query->execute(array(
      $img_uid));

    $result = $query->fetchAll();

    return $result;
  }

  function send_comment_email($img_url, $email){
    $folder = '/'.explode('/',$_SERVER['REQUEST_URI'])[1].'/';
    $subject = "New comment has arrived" ;
    $entete = "From: noreply@camagru.com" ;
     
    $message = 'Hi there !,
     
    A new comment has arrived on your picture !
    Click the link below to see it:  
    http://'.$_SERVER[HTTP_HOST].$folder.'show_pic.php?path='.urlencode($img_url).'
     
     
    ---------------
    Plz 125%';
     
     
    mail($email, $subject, $message, $entete) ; // Envoi du mail    
  }

?>