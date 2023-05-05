<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/login-signup.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
<form action="" method="POST">

  <div id="login">
    <div id="login-container">
      <div id="login-title"> <h1>Log in to your account</h1> </div>
      <div id="input-group">
        <div class="input-field">
          <input name="account" type="text" placeholder="Enter your Email or Username" required>
        </div>
        <div class="input-field">
          <input name="password" type="password" placeholder="Enter your Password" required>
        </div>
        <div id="btn-field"> <button name="submit" type="submit">Log in</button> </div>
        <div id="signup-link"> <p>Dont have an account? <a href="/signup">Sign up</a></p> </div>
      </div>
    </div>
  </div>

</form>
</main>

<!-- Footer Start -->
<?php // include "./views/partials/footer.php" ?>
<!-- Footer End -->

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script src="/src/user/js/login.js"></script>
<!-- Javascript End -->

</body>
</html>