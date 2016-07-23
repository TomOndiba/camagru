<?php
  include 'functions.php';
  include 'gallery_functions.php';

  $img_url = $_GET['path'];
  $img_uid = explode('.' ,explode('/', $img_url)[2])[0];
  $img_user = explode('/', $img_url)[1];
  $likes = get_likes($img_uid, $bdd);
  $comments = get_comments($img_uid, $bdd);
  $user_id = return_id($_SESSION['username'], $bdd);

    if (filter_has_var( INPUT_POST,  'comment' ))
  {
    $comment = parse_input($_POST['commentfield']);

    if (!empty($comment)){
      $req = $bdd->prepare('INSERT INTO comment(comment, user_id, picture_uid) VALUES(:comment, :user_id, :picture_uid)');
      $req->execute(array(
      'comment' => $comment,
      'user_id' => $user_id,
      'picture_uid' => $img_uid
      ));

      header('Location: show_pic.php?path='.$img_url);
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
    <p class="titles">Hello <?php echo $_SESSION["username"]; ?></p>
    <p class="sub-titles">
      Feel free to like or comment picture !
    </p>
  </div>

  <div class="gallery-uniq">
    <?php if ($img_user == $_SESSION['username']) { ?>
      <a href="gallery.php" onclick="destroyImg('<?php echo $img_uid; ?>', '<?php echo $user_id ?>'), id='destroyImgLink'">Delete picture ?</a>
      <div id="destroyImg"></div>
    <?php } ?>
    <img src="<?php echo $img_url ?>" id='img-uniq'><br>
   <?php if (connected()) { ?>
    <p style="float: left; cursor: pointer;" onclick="addLike(<?php echo '\''.$img_uid.'\', '.$user_id ?>)"><img src="assets/images/thumbs_up.png" width="100px"></a>
  <?php }else{ ?>
    <img src="assets/images/thumbs_up.png" width="100px">
  <?php } ?>
    <p id="likes"><?php echo $likes ?></p>
  </div>

  <div class="clear"></div>


  <div class="gallery-uniq">
    <? foreach ($comments as $key) { ?>
      <div class='comment-text'>
        <p><?php echo find_username($key['user_id'], $bdd) ?> wrote:</p>
        <p style="font-size: 20px"><?php echo $key['comment']; ?></p>
      </div>    
    <?php } ?>
  </div>

  <?php if (connected()) { ?>
    <div class="gallery-uniq">
      <form method="POST" name='comment'>
        <p>
          Comment:<br>
          <textarea name="commentfield" rows=3; cols=25></textarea>
        </p>
        <input type="submit" name="comment"  value="Poster">
      </form>
    </div>
  <?php } ?>

  </main>
  <?php include 'layouts/footer.html' ?> 
</body>
<script type="text/javascript" src="assets/javascripts/ajaxRequests.js"></script>
</html>