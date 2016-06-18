<?php
  include 'functions.php';
  $flag = "NOTHING HAPPENED";
   
   if (connected()){
    header("location: camagru.php");
    exit;
   }

  if (filter_has_var( INPUT_POST,  'login' ))
  {
    $email = parse_input($_POST["email"]);
    $password = parse_input($_POST["password"]);
    $query = $bdd->prepare("SELECT * FROM `user` WHERE `email` = '$email' ");

    if (empty($email) || empty($password))
    {
      $flag = "EMPTY VALUES";
      $error = "One field is empty";
    }
    else
    {
      $query->execute();
      $result = $query->fetch();
      if (password_verify($password, $result['password']))
      {
        $flag = "OK !";
        $_SESSION['username'] = $result['username'];
        $_SESSION['connected'] = true;
        header("location: camagru.php");
        exit;
      }
      else
        $flag = "NOT OK !";
    }
  }
?>


<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.html' ?>
    <main>
      <p class="titles">Sign In</p>
      <form method="post" name="login">
        <p>Email:<input type="text" name="email"></p>
        <p>Password:<input type="password" name="password"></p>
        <input type="submit" name="login" value="Sign In">
      </form>
      <br/>
      <p>Want to create an account ?<a href="./create.php"><button>Sign Up</button></a></p>
    </main>
  <?php include 'layouts/footer.html' ?>
  </body>
</html>