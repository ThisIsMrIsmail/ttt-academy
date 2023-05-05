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
    <div id="instructor-container">
      <div id="instructor-container-title"> <h1>Instructor Information</h1> </div>
      <div id="instructor-info">
        <div id="instructor-left-info">
          <div class="instructor-input">
            <label for="instructor_name">Instructor Name</label>
            <input type="text" id="instructor-name" name="instructor_name" placeholder="ex: Dr. Mohamed Ahmed" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_title">Instructor Title</label>
            <input type="text" id="instructor-title" name="instructor_title" placeholder="ex: Professor" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_email">Instructor Email</label>
            <input type="email" id="instructor-email" name="instructor_email" placeholder="ex: mohamed@gmail.com" required>
          </div>
        </div>
        <div id="instructor-right-info">
          <div class="instructor-input">
            <label for="instructor_contact_number">Instructor Contact Number</label>
            <input type="number" id="instructor-contact-number" name="instructor_contact_number" placeholder="ex: 01099451240" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_years_of_exp">Instructor Years of Experience</label>
            <input type="number" id="instructor-s-of-exp" name="instructor_years_of_exp" placeholder="ex: 7" required>
          </div>
          <div class="instructor-input">
            <label for="instructor_image">Instructor Image</label>
            <input type="file" id="instructor-img" name="instructor_img" required>
          </div>
        </div>
      </div>

      <div id="instructor-bio">
        <div id="instructor-bio-title"> <h1>Instructor Bio</h1> </div>
        <textarea name="instructor_bio" placeholder="Instructor Bio"></textarea>
      </div>
    </div>
    
    <div id="submittion-buttons">
      <button id="save-button" name="save_button" type="submit">Save</button>
      <a id="cancel-button" href="/admin/instructors"> <p>Cancel</p> </a>
    </div>
  </form>
  
</div>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script src="/src/admin/js/instructors-add-edit.js"></script>
<!-- Javascript End -->

</body>
</html> 