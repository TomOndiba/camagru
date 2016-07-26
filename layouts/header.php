<div class="wrapper">
<header>
	<nav>
		<ul>
			<div class="floatleft">
				<li class="special_text">
					<a href=".">Camagru</a>
				</li>
			</div>
      <div class="floatright">
        <li>
          <a href="gallery.php">Gallery</a>
        </li>
        <?php if (connected()){ ?>
          <li>
            <form method="POST" action=''>
              <input type="submit" name="signout"  value="Sign Out">
            </form>
          </li>
        <?php } ?>
      </div>
		</ul>
	</nav>
  <?php if(!empty($_SESSION['error'])) { ?>
    <div style="text-align: center;">
      <p style="color: red;">
        <?php echo $_SESSION['error']; $_SESSION['error'] = ''; ?>
      </p>
    </div>
  <?php } ?>
</header>
<div class="clear"></div>