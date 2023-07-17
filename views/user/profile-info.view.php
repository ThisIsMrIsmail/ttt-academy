<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/profile.css">
  <link rel="stylesheet" href="/src/user/css/profile-info.css">
</head>
<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<main>
<form action="" method="POST">
<input type="hidden" name="user_id" value="<?=$user['user_id']?>">

<div id="profile-page">
  <div id="left-section">
    <div id="left-section-top">
      <div id="profile-image">
        <?php
          $id = $user['user_id'];
          if ( file_exists("uploads/users/$id") ) {
            $img = glob("uploads/users/$id/image_$id.*")[0];
        ?>
          <img src="/<?=$img?>" alt="">
        <?php } else { ?>
          <img src="/src/partials/user-img/user-img-0.jpg" alt="">
        <?php } ?>
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
      <h2>Profile Info</h2>
      <p>Add or edit information about yourself.</p>
    </div>
          
    <div id="right-section-bottom">
      <div class="input-field" id="full-name">
        <input type="text" name="fullname" value="<?=$user['user_full_name']?>" placeholder="Full Name" required>
      </div>
      <div class="input-field" id="username" title="Username can't be edited">
        <input type="text" name="username" value="<?=$user['username']?>" placeholder="Username" disabled>
      </div>
      <div class="input-field" id="age" title="Age can't be edited">
        <input type="number" name="age" value="<?=$user['user_age']?>" placeholder="Age" disabled>
      </div>
      <div class="input-field" id="contact-number">
        <input type="number" name="contact_number" value="<?=$user['user_contact_number']?>" placeholder="Contact number">
      </div>
      <div class="input-field" id="bio">
        <textarea name="bio" placeholder="Tell us about yourself..."><?=$user['user_bio']?></textarea>
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



  
</body>
</html>