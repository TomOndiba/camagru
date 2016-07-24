<?php
  include 'functions.php';

  if (!connected()){
    $_SESSION['error'] = 'please login first';
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
  <?php include 'layouts/header.php' ?>
    <main>
    <div class="presentation-text">
      <p class='titles' id="demo">Hello <?php echo $_SESSION["username"] ?></p>
      <div id="imgsrc"></div>
    </div>
      <div class="pic-and-gallery">
        <div class="pic-and-gallery-div">          
          <p class="sub-titles">1 - Take your picture</p>
            <video id="video"></video><br>
            <button id="startbutton">Take a picture</button>            
        </div>
        <div class="pic-and-gallery-div mini-gallery" id='the-mini-gallery'>
          <?php include 'layouts/mini-gallery.php'; ?>
        </div>
      </div>
      <div class="clear"></div>
        <div class="presentation-text">
          <p class="sub-titles">2 - Snapchat it</p>
          <input type='file' name='img' size='65' id='uploadimage' /><br>
          <button class="draw" onClick="drawMode()">DRAWING OFF</button>
          <button id="black" onClick="drawColor = '#000000'">black</button>
          <button id="white" onClick="drawColor = '#FFFFFF'">white</button>
          <button id="cyan" onClick="drawColor = '#00ffff'">cyan</button>
          <button id="yellow" onClick="drawColor = '#FFFF00'">yellow</button><br>
          <canvas id="canvas"></canvas>
        </div>
        <div class="presentation-text">
          <p class="sub-titles">3 - Choose your frame</p>
          <img src="./assets/images/grue.jpg" id="photo" alt="photo" width="500"><br>
          <button type="submit" name='frame-violet' class="frame-button" onClick="getImageUrl('violet', '<?php echo $_SESSION['username']; ?>')">
            <img src="frames/violet.png" width="30" height="30" alt="submit">
          </button>
          <button type="submit" name='frame-wood' class="frame-button" onClick="getImageUrl('wood', '<?php echo $_SESSION['username']; ?>')">
            <img src="frames/wood.png" width="30" height="30" alt="submit">
          </button>
          <button type="submit" name='frame-pkmngo' class="frame-button" onClick="getImageUrl('pkmngo', '<?php echo $_SESSION['username']; ?>')">
            <img src="frames/pkmngo.png" width="30" height="30" alt="submit">
          </button>          
        </div>
    </main>
  <?php include 'layouts/footer.html' ?>
  </body>
  <script type="text/javascript" src="assets/javascripts/webcam.js"></script>
  <script type="text/javascript" src="assets/javascripts/paint.js"></script>
  <script type="text/javascript" src="assets/javascripts/loadImage.js"></script>
  <script type="text/javascript" src="assets/javascripts/ajaxRequests.js"></script>
</html>