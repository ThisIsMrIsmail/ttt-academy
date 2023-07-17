<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Instructor | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/admin/css/instructors-add-edit.css">
</head>


<body>

<!-- Header Start -->
<?php include "./views/partials/admin-header.php" ?>
<!-- Header End -->


<main>
<div id="instructor">
  <!------------------------------->
  <!--# Instructor: ADD or EDIT FORM -->
  <!------------------------------->
  <form action="" method="POST" id="instructor-form" enctype="multipart/form-data">
  <input type="hidden" name="instructor_id" value="<?=$instructor['instructor_id']?>">
    <div id="instructor-container">
      <div id="instructor-container-title"> <h1>Instructor Information</h1> </div>
      <div id="instructor-info">
        <div id="instructor-left-info">
          <div class="instructor-input">
            <label for="instructor_name">Instructor Name</label>
            <input type="text" id="instructor-name" name="instructor_name" value="<?=$instructor['instructor_full_name']?>"  placeholder="ex: Dr. Mohamed Ahmed" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_title">Instructor Title</label>
            <input type="text" id="instructor-title" name="instructor_title" value="<?=$instructor['instructor_title']?>"  placeholder="ex: Professor" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_email">Instructor Email</label>
            <input type="email" id="instructor-email" name="instructor_email" value="<?=$instructor['instructor_email']?>"  placeholder="ex: mohamed@gmail.com" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_contact_number">Instructor Contact Number</label>
            <input type="number" id="instructor-contact-number" name="instructor_contact_number" value="<?=$instructor['instructor_contact_number']?>" placeholder="ex: 01099451240" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_years_of_exp">Instructor Years of Experience</label>
            <input type="number" id="instructor-years-of-exp" name="instructor_years_of_exp" value="<?=$instructor['instructor_years_of_experience']?>" placeholder="ex: 7" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_image">Instructor Image</label>
            <input type="file" id="instructor-img" name="instructor_img" accept="image/.png,.jpg,.jpeg">
          </div>
        </div>
        <div id="instructor-right-info">
        <img src="/<?=$instructor_img[0]?>" alt="">
        </div>
      </div>

      <div id="instructor-bio">
        <div id="instructor-bio-title"> <h1>Instructor Bio</h1> </div>
        <textarea name="instructor_bio" placeholder="Instructor Bio" required> <?=$instructor['instructor_bio']?> </textarea>
      </div>
    </div>
    
    <div id="submittion-buttons">
      <button id="save-button" name="save_button" type="submit">Save</button>
      <a id="cancel-button" href="/admin/instructors"> <p>Cancel</p> </a>
    </div>
  </form>

  <!--% NOTE
    should only be displayed if displaying a instructor
    should not be displayed if adding new instructor -->
  <!-------------------------->
  <!--# Instructor: REMOVE FORM -->
  <!-------------------------->
  <form action="" method="POST">
    <input type="hidden" name="action" value="DELETE">
    <input type="hidden" name="instructor_id" value="<?=$instructor["instructor_id"]?>">
    <div id="remove-instructor">
      <h2>Danger Zone</h2>
      <p>If you press this button, This instructor will be permanently <strong>DELETED</strong>,&nbsp;
        Including all of the instructor information.</p>
      <button id="show-dialog" type="button">Remove Instructor</button>
    </div>
    <dialog>
      <p><strong style="color: #000000;">Are you sure you want to remove this instructor?</strong></p>
      <button id="close-dialog" type="button">Canel</button>
      <button id="submit-dialog" name="remove_instructor" type="submit">Remove</button>
    </dialog>
  </form>
  
</div>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script src="/src/admin/js/instructors-add-edit.js"></script>
<!-- Javascript End -->

</body>
</html> 