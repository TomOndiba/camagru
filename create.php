<?php
  include 'functions.php';

   if (connected()){
    header("location: camagru.php");
    exit;
   }

  if (filter_has_var( INPUT_POST,  'signup' ))
  {
    $email = parse_input($_POST["email"]);
    $password = parse_input($_POST["password"]);
    $username = parse_input($_POST["username"]);
    $token = md5(microtime(TRUE)*100000);
    
    $query = $bdd->prepare("SELECT COUNT('id') FROM `user` WHERE `email` = '$email'");
    $query->execute();
    $result = $query->fetchColumn();

    if ($result)
    {
      header('location: create.php');
      $_SESSION['error'] = "email already taken";
      return;
    }

    $req = $bdd->prepare('INSERT INTO user(email, password, username, token) VALUES(:email, :password, :username, :token)');

    if (empty($email) || empty($password) || empty($username))
    {
      $_SESSION['error'] = "One field is empty";
    }
    elseif (strlen($password) < 6 ) {
      $_SESSION['error'] = "Password too weak";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['error'] = "Enter valid email";
    }
    else
    {
      $req->execute(array(
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'username' => $username,
      'token' => $token
      ));
      $_SESSION['username'] = $username;
      $_SESSION['connected'] = true;
      confirmation_mail($email, $username, $token);
      header('location: index.php');
    }
  }
?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.php' ?>
    <main>
      <div class="presentation-text">
        <p class="titles">Sign Up</p>
        <form method="post" name="signup">
          <p>Email:<input type="text" name="email"></p>
          <p>Username:<input type="text" name="username"></p>
          <p>Password:<input type="password" name="password"></p>
          <input type="submit" name="signup" value="Create User">
        </form>
        <a href="./">Sign In</a>
      </div>
    </main>
    <?php include 'layouts/footer.html' ?>
  </body>
</html>