<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Course | TTT</title>
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
  <form action="" method="POST"  id="course-form" enctype="multipart/form-data">
    <!-- course id to for submittion -->
    <input type="hidden" name="course_id" value="<?=$course["course_id"]?>">
    <div id="course-container">
      <div id="course-title"> <h1>Course Information</h1> </div>
      <div id="course-info">
        <div id="course-left-info">
          <div class="course-input">
            <label for="course_name">Course Title</label>
            <input type="text" id="course-name" name="course_name" value="<?=$course["course_name"]?>"  placeholder="ex: The Complete Course for ..." required>
          </div>
          <div class="course-input">
            <label for="course_price">Course Price (in $)</label>
            <input type="number" id="course-price" name="course_price" value="<?=$course["course_price"]?>" placeholder="ex: 20.99$" required>
          </div>
          <div class="course-input">
            <label for="course_video">Course Video</label>
            <input type="file" id="course-video" name="course_video" accept="video/mp4">
          </div>
          <div class="course-input">
            <label for="course_video">Course Video Thumbnail</label>
            <input type="file" id="course-thumbnail" name="course_thumbnail" accept="images/.jpg, .png, .jpeg">
          </div>
          <div class="course-input">
            <label for="course_instructor">Course Instructor</label>
            <select id="course-instructor" name="instructor_id">
              <?php if ( isset($instructor) ) { ?>
                <option value="<?=$instructor["instructor_id"]?>">
                  <?=$instructor["instructor_full_name"]?> : <?=$instructor["instructor_title"]?>
                </option>
              <?php } ?>
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
          <?php if ( isset($course_video) ): ?>
              <video muted controlslist="nodownload" controls="controls" preload="auto"
              <?php if ( isset($course_thumbnail) ): ?>
                poster="/<?=$course_thumbnail[0]?>">
              <?php else: ?>
                poster="">
              <?php endif; ?>
                <source src="/<?=$course_video[0]?>" type="video/mp4">
              </video>
          <?php else: ?>
              <video src=""></video>
          <?php endif; ?>
        </div>
      </div>
      <div id="course-description">
        <div id="course-description-title"> <h1>Description</h1> </div>
        <textarea name="course_description" placeholder="Course Description" required><?=$course["course_description"]?></textarea>
      </div>
    </div>
  
    <div id="levels">
      <div id="levels-container">
        <div id="levels-title"> <h1>Levels</h1> </div>
        <div id="add-level"> <button type="button" onclick="add_level()">Add Level</button> </div>
      </div>
      <!--TODO: uncomment this div when you use php and retrive data -->
      <?php for ($i=0; $i < count($levels); $i++) { ?>
      <div class="level" id="l<?=$i?>">
        <!-- level id for submmition -->
        <div class="level-title"> <h3>Level</h3> </div>
        <div class="level-container">
          <div class="level-input" id="level-name">
            <label for="level-name">Level Name</label>
            <input type="text" name="levels[<?=$i?>][level_name]" value="<?=$levels[$i]["level_name"]?>" placeholder="ex: Programming Fundamentals" required>
          </div>
          <div class="level-input" id="level-duration">
            <label for="level-duration">Level Duration (hours)</label>
            <input type="number" name="levels[<?=$i?>][level_duration]" value="<?=$levels[$i]["level_duration"]?>" placeholder="ex: 10 Hours" required>
          </div>
          <div class="remove-level">
              <button name="remove_level_button" type="button" onclick='remove_level("l<?=$i?>")'>Remove Level</button>
          </div>
        </div>
        <div id="level-description">
          <label for="level-description">Description</label>
          <textarea name="levels[<?=$i?>][level_description]" placeholder="Level Description" required><?=$levels[$i]["level_description"]?></textarea>
        </div>
      </div>
      <?php } ?>
    </div>
    
    <div id="submittion-buttons">
      <input type="hidden" name="action" value="PUT">
      <button id="save-button" name="save_button" type="submit">Save</button>
      <a id="cancel-button" href="/admin/courses"> <p>Cancel</p> </a>
    </div>
  </form>

  <!--% NOTE
    should only be displayed if displaying a course
    should not be displayed if adding new course -->
  <!-------------------------->
  <!--# Course: REMOVE FORM -->
  <!-------------------------->
  <form action="" method="post">
    <input type="hidden" name="action" value="DELETE">
    <input type="hidden" name="course_id" value="<?=$course["course_id"]?>">
    <div id="remove-course">
      <h2>Danger Zone</h2>
      <p>If you press this button, The course will be permanently <strong>DELETED</strong>,&nbsp;
        Including all of the course content.</p>
      <button id="show-dailog" type="button">Remove Course</button>
    </div>
    <dialog>
      <p><strong style="color: #000000;">Are you sure you want to remove this course?</strong></p>
      <button id="close-dailog" type="button">Canel</button>
      <button id="submit-dailog" name="remove_course" type="submit">Remove</button>
    </dialog>
  </form>

</div>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script src="/src/admin/js/courses-add-edit.js"></script>
<!-- Javascript End -->

</body>
</html> 