<?php
  include 'functions.php';

  if (!connected()){
    header("location: index.php");
    exit;
  }
  if(!confirmed($_SESSION["username"], $bdd)){
    header("location: waiting.php");
    exit;    
  }

?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.html' ?>
    <main>
      <p class='titles'>Hello <?php echo $_SESSION["username"] ?></p>


      <div class="camagru-center">
      </div>

      <div class="camagru-right">
        
      </div>
      <form method="POST" action=''>
        <input type="submit" name="signout"  value="Sign Out">
      </form>
    </main>
  <?php include 'layouts/footer.html' ?>
  </body>
</html>