<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/profile.css">
  <link rel="stylesheet" href="/src/user/css/account-security.css">
</head>
<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<main>

<div id="profile-page">
  <div id="left-section">
    <div id="left-section-top">
      <div id="profile-image">
        <?php
          $id = $user['user_id'];
          if ( file_exists("uploads/users/$id") )
            if ( glob("uploads/users/$id/image_$id.*")[0] )
              $img = glob("uploads/users/$id/image_$id.*")[0];
            else
              $img = "src/partials/user-img/user-img-0.jpg";
          else
            $img = "src/partials/user-img/user-img-0.jpg";
        ?>
        <img src="/<?=$img?>" alt="">
      </div>
      <div id="profile-name"> <h3><?=$user['user_full_name']?></h3> </div>
    </div>

    <div id="left-section-bottom">
      <div class="profile-link" id="profile-info">
        <a href="/profile/profile-info"><p>Profile Info</p></a>
      </div>
      <div class="profile-link" id="profile-change-img">
        <a href="/profile/profile-image"><p>Profile Image</p></a>
      </div>
      <div class="profile-link" id="account-security">
        <a href="/profile/account-security"><p>Account Security</p></a>
      </div>
      <div class="profile-link" id="delete-account">
        <a href="/profile/delete-account"><p>Delete Account</p></a>
      </div>
    </div>
  </div>

  <div id="right-section">
    <div id="right-section-top">
      <h2>Account Security</h2>
      <p>You change your account email or password.</p>
    </div>

    <div id="right-section-bottom">
    <!-- FORM for changing email -->
    <form action="" method="post" id="email-form">
      <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
      <div class="input-field" id="old-email"> <h3>Email:</h3> </div>
      <div class="input-field">
        <input type="email" name="old_email" placeholder="Enter current email" required>
      </div>
      <div class="input-field">
        <input type="email" name="new_email" placeholder="Enter new email" required>
      </div>
      <div id="save-button"> <button name="change_email" type="submit">Save</button> </div>
    </form>

    <!-- FORM for changing password -->
    <form action="" method="post" id="password-form">
      <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
      <div class="input-field"> <h3>Password:</h3> </div>
      <div class="input-field">
        <input type="password" name="old_password" placeholder="Enter current password" minlength="8" required>
      </div>
      <div class="input-field">
        <input type="password" name="new_password" placeholder="Enter new password" minlength="8" required>
      </div>
      <div id="save-button"> <button name="change_password" type="submit">Save</button> </div>
    </form>
    </div>
  </div>
</div>

</main>

<!-- Footer Start -->
<?php include "./views/partials/footer.php" ?>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>

</body>
</html>