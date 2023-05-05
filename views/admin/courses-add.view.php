<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Course | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/admin/css/courses-add-edit.css">
</head>


<body>

<!-- Header Start -->
<?php include "./views/partials/admin-header.php" ?>
<!-- Header End -->


<main>
<div id="course">
  <!------------------------------->
  <!--# Course: ADD or EDIT FORM -->
  <!------------------------------->
  <form action="" method="POST" id="course-form" enctype="multipart/form-data">
    <div id="course-container">
      <div id="course-title"> <h1>Course Information</h1> </div>
      <div id="course-info">
        <div id="course-left-info">
          <div class="course-input">
            <label for="course_name">Course Title</label>
            <input type="text" id="course-name" name="course_name" value=""  placeholder="ex: The Complete Course for ..." required>
          </div>
          <div class="course-input">
            <label for="course_price">Course Price (in $)</label>
            <input type="number" id="course-price" name="course_price" value="" placeholder="ex: 20.99$" required>
          </div>
          <div class="course-input">
            <label for="course_instructor">Course Instructor</label>
            <select id="course-instructor" name="instructor_id">
              <option value="">-- select --</option>
              <?php foreach ($instructors as $key => $instructor): ?>
                <option value="<?=$instructor["instructor_id"]?>">
                  <?=$instructor["instructor_full_name"]?> : <?=$instructor["instructor_title"]?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div id="course-right-info">
          <div class="course-input">
            <label for="course_video">Course Video</label>
            <input type="file" id="course-video" name="course_video" accept="video/mp4" required>
          </div>
          <div class="course-input">
            <label for="course_video">Course Video Thumbnail</label>
            <input type="file" id="course-thumbnail" name="course_thumbnail" accept="images/.jpg, .png, .jpeg" required>
          </div>
        </div>
      </div>
      <div id="course-description">
        <div id="course-description-title"> <h1>Description</h1> </div>
        <textarea name="course_description" placeholder="Course Description" required></textarea>
      </div>
    </div>
  
    <div id="levels">
      <div id="levels-container">
        <div id="levels-title"> <h1>Levels</h1> </div>
        <div id="add-level"> <button type="button" onclick="add_level()">Add Level</button> </div>
      </div>
    </div>
    
    <div id="submittion-buttons">
      <button id="save-button" name="save_button" type="submit">Save</button>
      <a id="cancel-button" href="/admin/courses"> <p>Cancel</p> </a>
    </div>
  </form>
</div>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script src="/src/admin/js/courses-add-edit.js"></script>
<!-- Javascript End -->

</body>
</html> 