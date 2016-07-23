<?php
  include 'functions.php';

  if (filter_has_var( INPUT_POST,  'reset_password_request' ))
  {
    $email = parse_input($_POST["email"]);
    reset_password_mail($email, $bdd);
  }
?>

<!DOCTYPE html>
<html>
  <?php include 'layouts/head.html' ?>
  <body>
  <?php include 'layouts/header.html' ?>
    <main>
      <div class="presentation-text">
        <p class='titles'>Reset your password</p>

        <form method="post" name="reset_password_request">
          <p>Please fill with your email</p>
          <p>Email:<input type="text" name="email">
          <input type="submit" name="reset_password_request" value="Send"></p>
        </form>
      </div>
    </main>
  <?php include 'layouts/footer.html'; ?>
  </body>
</html>