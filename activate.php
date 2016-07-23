<?php
  include 'functions.php';

   $confirmation = confirmation($_GET['username'], $_GET['token'], $bdd);

?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.php' ?>
  <main>
    <div class="presentation-text">
      <div class="activate-message">
        <p class="titles"><?php echo $confirmation ?></p>
      </div>
    </div>
  </main>
  <?php include 'layouts/footer.html' ?>
  </body>
</html>