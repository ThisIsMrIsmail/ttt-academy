<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/profile.css">
  <link rel="stylesheet" href="/src/user/css/delete-account.css">
</head>
<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<main>

<form action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="user_id" value="<?=$user['user_id']?>">

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
      <h2>Delete Account</h2>
      <p>You can delete your account when ever you want.</p>
    </div>
  
    <div id="danger-zone">
      <h2>Warning:</h2>
      <p>
        If you press this button, your account will be
        <strong>permanently DELETED</strong>,&nbsp; Including all of your data.
      </p>
      <div id="delete-button">
        <button id="show-dialog" type="button">Delete Account</button>
      </div>
      <dialog>
        <p><strong style="color: #000000;">Are you sure you want to delete your account?</strong></p>
        <button id="close-dialog" type="button">Canel</button>
        <button id="submit-dialog" name="delete" type="submit">Delete</button>
      </dialog>
    </div>
  </div>
</div>

</form>
</main>

<!-- Footer Start -->
<?php include "./views/partials/footer.php" ?>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>

</body>
</html>