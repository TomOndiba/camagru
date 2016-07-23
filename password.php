<?php
  include 'functions.php';

  if (!reset_password($_GET['username'], $_GET['token'], $bdd)){
    header("location: index.php");
    exit;
  }

  if (filter_has_var( INPUT_POST,  'reset_password' ))
  {
    $password = parse_input($_POST["password"]);
    $username = $_GET['username'];
    if (strlen($password) > 5 )
    {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $query = $bdd->prepare("UPDATE user SET password='$password' WHERE `username` = '$username'");
      $query->execute();
      header("location: camagru.php");
    }
  }
?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.html' ?>
    <main>
    <div class="presentation-text">
      <p class='titles'>Hello <?php echo $_SESSION["username"] ?></p>
      <p>If you forgot your password please fill field below</p>
      <form method="post" name="reset_password">
        <p>Password:<input type="password" name="password">
        <input type="submit" name="reset_password" value="Reset"></p>
      </form>
    </div>
    </main>
  <?php include 'layouts/footer.html' ?>
  </body>
</html>