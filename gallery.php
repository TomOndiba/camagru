<?php
  include 'functions.php';
  include 'gallery_functions.php';

  if (is_null($_GET['p']))
    $page = 0;
  else
    $page = $_GET['p'];
  $pics = get_pictures_paths($page, $bdd);

?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.html' ?>
  <main>
  <p class="titles">Hello <?php echo $_SESSION["username"]; ?></p>
  <p class="sub-titles">
    You'll find here all previous taken pictures. <br />
    Thanks, and have fun
  </p>


  <form method="POST" action=''>
    <input type="submit" name="signout"  value="Sign Out">
  </form>
  </main>
  <?php include 'layouts/footer.html' ?> 
</body>
</html>