<?php
  include 'functions.php';
  include 'gallery_functions.php';

  $img_url = $_GET['path'];
  $img_uid = explode('.' ,explode('/', $img_url)[2])[0];
  $likes = get_likes($img_uid, $bdd);
  $user_id = return_id($_SESSION['username'], $bdd);

?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.html' ?>
  <main>
  <p class="titles">Hello <?php echo $_SESSION["username"]; ?></p>
  <p class="sub-titles">
    Feel free to like or comment picture !
  </p>

  <div class="gallery">
    <img src="<?php echo $img_url ?>"><br>
    <a href="#" style="float: left;" onclick="addLike(<?php echo '\''.$img_uid.'\', '.$user_id ?>)"><img src="assets/images/thumbs_up.png" width="100px"></a>
    <p id="likes"><?php echo $likes ?></p>
  </div>

  <form method="POST" action=''>
    <input type="submit" name="signout"  value="Sign Out">
  </form>
  </main>
  <?php include 'layouts/footer.html' ?> 
</body>
<script type="text/javascript" src="assets/javascripts/ajaxRequests.js"></script>
</html>