<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/login-signup.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
  <div id="signup">
    <div id="signup-container">
      <div id="signup-title"> <h1>Create an account</h1> </div>
      <form action="" method="POST">
        <div id="input-group">
          <div class="input-field"> <input type="text" name="fullname" id="fullname" placeholder="Full Name" required> </div>
          <div class="input-field">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="text" class="number" name="age" id="age" placeholder="Age" maxlength="2" required>
          </div>
          <div class="input-field"> <input type="email" name="email" id="email" placeholder="Email" required> </div>
          <div class="input-field"> <input type="password" name="password" id="password" placeholder="Password" minlength="8" required> </div>
          <div id="btn-field"> <button name="submit" id="submit-button" type="submit">Sign up</button> </div>
          <div id="login-link"> <p>Already have an account? <a href="/login">Log in</a></p> </div>
        </div>
      </form>
    </div>
  </div>
</main>

<!-- Footer Start -->
<?php include "./views/partials/footer.php" ?>
<!-- Footer End -->

<!-- Javascript Start -->
<script src="/src/user/js/signup.js"></script>
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

<!-- Getting verification code dialog -->
<?php require "./views/user/verify.view.php" ?>


</body>  
</html>