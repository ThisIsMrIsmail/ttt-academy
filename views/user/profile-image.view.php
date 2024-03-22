<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/profile.css">
  <link rel="stylesheet" href="/src/user/css/profile-image.css">
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
      <h2>Profile Image</h2>
      <p>Add a nice photo of yourself for your profile.</p>
    </div>
  
    <div id="right-section-bottom">
      <div id="image-preview"> <p>No file currently selected for upload</p> </div>
      <div class="input-field" id="profile-img-upload">
        <input type="file" name="image" accept="image/*" required>
      </div>
      
      <div id="save-button"> <button name="save" type="submit">Save</button> </div>
    </div>
  </div>
</div>

</form>
</main>

<!-- Footer Start -->
<?php include "./views/partials/footer.php" ?>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script src="/src/user/js/profile-image.js"></script>

</body>
</html>