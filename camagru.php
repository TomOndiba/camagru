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
      <p class='titles' id="demo">Hello <?php echo $_SESSION["username"] ?></p>
      <div id="imgsrc"></div>

       <div class="camagru-center" id='paint'>
          
          <p class="sub-titles">1 - Take your picture</p>
            <video id="video"></video><br>
            <button id="startbutton">Prendre une photo</button>
            <p class="sub-titles">2 - Snapchat it</p>
            <input type='file' name='img' size='65' id='uploadimage' />
            <button class="draw" onClick="drawMode()">DRAWING OFF</button>
            <button id="black" onClick="drawColor = '#000000'">black</button>
            <button id="white" onClick="drawColor = '#FFFFFF'">white</button>
            <button id="cyan" onClick="drawColor = '#00ffff'">cyan</button>
            <button id="yellow" onClick="drawColor = '#FFFF00'">yellow</button><br>
            
            <canvas id="canvas"></canvas>
            <p class="sub-titles">3 - Choose your frame</p>
            <img src="./assets/images/grue.jpg" id="photo" alt="photo"><br>
            <button type="submit" name='frame-violet' class="frame-button" onClick="getImageUrl('violet', '<?php echo $_SESSION['username']; ?>')">
              <img src="frames/violet.png" width="30" height="30" alt="submit">
            </button>
            <button type="submit" name='frame-wood' class="frame-button" onClick="getImageUrl('wood', '<?php echo $_SESSION['username']; ?>')">
              <img src="frames/wood.png" width="30" height="30" alt="submit">
            </button>
            <button type="submit" name='frame-hipster' class="frame-button" onClick="getImageUrl('hipster', '<?php echo $_SESSION['username']; ?>')">
              <img src="frames/hipster.png" width="30" height="30" alt="submit">
            </button>                               

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
  <script type="text/javascript" src="assets/javascripts/ajaxRequests.js"></script>
</html>