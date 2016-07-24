<?php
  if (!empty($_POST['mini_gallery'])){
    include '../functions.php';
  }
  $img_paths = get_all_images($bdd);
?>

  <p class="sub-titles">Last pictures</p>
  <?php foreach ($img_paths as $key) { ?>
    <a href="show_pic.php?path=<?php echo $key; ?>"><img src="<?php echo $key; ?>" class="mini-image"></a>
  <?php } ?>