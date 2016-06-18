<?php
  include 'functions.php';

   $confirmation = confirmation($_GET['username'], $_GET['token'], $bdd);

?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.html' ?>
  <main>
    <div class="activate-message">
      <p class="titles"><?php echo $confirmation ?></p>
    </div>
    <form method="POST" action=''>
      <input type="submit" name="signout"  value="Sign Out">
    </form>
  </main>
  <?php include 'layouts/footer.html' ?>
  </body>
</html>