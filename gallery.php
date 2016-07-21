<?php
  include 'functions.php';
  include 'gallery_functions.php';

  if (is_null($_GET['p']))
    $page = 0;
  else
    $page = $_GET['p'];
  $pics = get_pictures_paths($page, $bdd);
  $total_rows = get_total_pictures($bdd);
  $total_pages = ceil($total_rows / 9);

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

  <div class="gallery">
    <?php foreach($pics as $key){ ?>
      <div class="gallery-pic">
        <img src="<?php echo $key; ?>", width="200px">
      </div>

    <?php } ?>
  </div>

  <div class="pages">
    <p>Select page</p>
    <?php for ($i=1; $i <= $total_pages ; $i++) {?> 
      <a href="gallery.php?p=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php } ?>
  </div>

  <form method="POST" action=''>
    <input type="submit" name="signout"  value="Sign Out">
  </form>
  </main>
  <?php include 'layouts/footer.html' ?> 
</body>
</html>