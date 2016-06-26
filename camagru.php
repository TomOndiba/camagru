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


      <div class="camagru-center" id='paint'>
        <video id="video"></video>
        <button id="startbutton">Prendre une photo</button><br>
        <input type='file' name='img' size='65' id='uploadimage' /><br>
        <button class="draw" onClick="drawMode()">draw</button><br>
        <canvas id="canvas"></canvas>
        <img src="./assets/images/grue.jpg" id="photo" alt="photo">
      </div>

      <div class="camagru-right">
        
      </div>
      <form method="POST" action=''>
        <input type="submit" name="signout"  value="Sign Out">
      </form>
    </main>
  <?php include 'layouts/footer.html' ?>
  </body>
  <script type="text/javascript" src="assets/javascripts/webcam.js"></script>
  <script type="text/javascript" src="assets/javascripts/paint.js"></script>
  <script type="text/javascript" src="assets/javascripts/loadImage.js"></script>
</html>