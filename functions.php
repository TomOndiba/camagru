<?php

  include_once 'config/database.php';
  include_once 'add_frames.php';
  session_start();
  
  try{$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
  catch(Exception $e) { die('Erreur : ' . $e->getMessage());}

  function parse_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function connected(){
    return (!empty($_SESSION['connected']) && $_SESSION['connected']);
  }

  function reset_password($username, $token, $bdd){
    $query = $bdd->prepare("SELECT * FROM `user` WHERE `username` = '$username' ");
    $query->execute();

    $result = $query->fetch();

    if (empty($result))
      return(false);

    $id = $result['id'];

    if ($result['token'] == $token){
      return(true);
    }
    return(false);    
  }

  function confirmation_mail($email, $username, $token){
    $url = $_SERVER[HTTP_HOST].explode('/', $_SERVER[REQUEST_URI])[0].'/';
    $subject = "Activate your account" ;
    $entete = "From: inscription@camagru.com" ;
     
    $message = 'Welcome to Camagru,
     
    To activate your account, please click the link below  
    http://'.$_SERVER[HTTP_HOST].'/camagru/activate.php?username='.urlencode($username).'&token='.urlencode($token).'
     
     
    ---------------
    Plz 125%';
     
     
    mail($email, $subject, $message, $entete) ; // Envoi du mail

  }

    function reset_password_mail($email, $bdd){
    $query = $bdd->prepare("SELECT * FROM `user` WHERE `email` = '$email' ");
    $query->execute();
    $result = $query->fetch();

    if (empty(result))
      return (false);

    $username = $result['username'];
    $token = $result['token'];

    $url = $_SERVER[HTTP_HOST].explode('/', $_SERVER[REQUEST_URI])[0].'/';
    $subject = "Password Forgotten" ;
    $entete = "From: password@camagru.com" ;
     
    $message = 'So your forgot your password,
     
    To get a new one, please click the link below  
    http://'.$_SERVER[HTTP_HOST].'/camagru/password.php?username='.urlencode($username).'&token='.urlencode($token).'
     
     
    ---------------
    Plz 125%';
     
     
    mail($email, $subject, $message, $entete) ; // Envoi du mail

  }

  function confirmation($username, $token, $bdd){
    $query = $bdd->prepare("SELECT * FROM `user` WHERE `username` = '$username' ");
    $query->execute();

    $result = $query->fetch();
    if (empty($result))
      return("User does not exist ;(");

    $id = $result['id'];

    if ($result['token'] == $token){
      $query = $bdd->prepare("UPDATE user SET valid=1 WHERE id=$id");
      $query->execute();
      $_SESSION['username'] = $username;
      $_SESSION['connected'] = true;
      return("Congrats ! Your account had been validated");
    }
    return("Bad token :(");
  }

  function confirmed($username, $bdd){
    $query = $bdd->prepare("SELECT * FROM `user` WHERE `username` = '$username' ");
    $query->execute();
    $result = $query->fetch();
    if (empty($result))
      return(false);
    if ($result['valid'])
      return (true);
    else
      return (false);
  }

  if (filter_has_var( INPUT_POST,  'signout' ))
  {
    $_SESSION['connected'] = false;
    $_SESSION['username'] = '';
    header("location: index.php");
  }
?>