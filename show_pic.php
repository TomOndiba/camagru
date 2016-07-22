<?php
  include 'functions.php';
  include 'gallery_functions.php';

  $img_url = $_GET['path'];
  $img_uid = explode('.' ,explode('/', $img_url)[2])[0];
  $img_user = explode('/', $img_url)[1];
  $likes = get_likes($img_uid, $bdd);
  $user_id = return_id($_SESSION['username'], $bdd);

    if (filter_has_var( INPUT_POST,  'comment' ))
  {
    $comment = parse_input($_POST['commentfield']);

    if (!is_null($comment)){
      $req = $bdd->prepare('INSERT INTO comment(comment, user_id, picture_uid) VALUES(:comment, :user_id, :picture_uid)');
      $req->execute(array(
      'comment' => $comment,
      'user_id' => $user_id,
      'picture_uid' => $img_uid
      ));    
    }
  }

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
    <?php if ($img_user == $_SESSION['username']) { ?>
      <a href="gallery.php" onclick="destroyImg('<?php echo $img_uid; ?>', '<?php echo $user_id ?>'), id='destroyImgLink'">Delete picture ?</a>
      <div id="destroyImg"></div>
    <?php } ?>
    <img src="<?php echo $img_url ?>"><br>
    <a href="#" style="float: left;" onclick="addLike(<?php echo '\''.$img_uid.'\', '.$user_id ?>)"><img src="assets/images/thumbs_up.png" width="100px"></a>
    <p id="likes"><?php echo $likes ?></p>
  </div>


  <div class="comment-gallery">
    <form method="POST" name='comment'>
      <p>
        Comment:<br>
        <textarea name="commentfield" rows=3; cols=40></textarea>
      </p>
      <input type="submit" name="comment"  value="Poster">
    </form>
  </div>

  <form method="POST" action=''>
    <input type="submit" name="signout"  value="Sign Out">
  </form>
  </main>
  <?php include 'layouts/footer.html' ?> 
</body>
<script type="text/javascript" src="assets/javascripts/ajaxRequests.js"></script>
</html>