<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Courses | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/all-courses.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>

<div id="courses">
  
  <?php if ( ! $rows_of_courses ) { ?>
    <div id="courses-title">
      <h2>wait for updates</h2>
      <h1>There are no Courses right now</h1>
    </div>
  <?php } else { ?>
    <div id="courses-title"> <h1>All Courses</h1> </div>
  <?php } ?>

  <?php foreach ($rows_of_courses as $key => $courses): ?>
    <div class="courses-container">
      <?php foreach ($courses as $key => $course): ?>
        <a class="course-box" href="/all-courses/<?=$course['course_id']?>">
          <div class="course-img">
          <?php 
            $id = $course['course_id'];
            if ( file_exists("uploads/courses/$id") ) {
              $img = glob("uploads/courses/$id/thumbnail_$id.*")[0];
          ?>
            <img src="/<?=$img?>" alt="">
          <?php } ?>
          </div>
          <div class="course-info">
            <div class="course-title">
              <h2> <?php
                // limiting number of displayed characters of course name
                echo strlen($course["course_name"]) >= 40 ? 
                substr($course["course_name"], 0, 40) . "..." :
                $course["course_name"] ?>
              </h2>
            </div>
            <div class="course-description">
              <p> <?php
                // limiting number of displayed characters of course description
                echo strlen($course["course_description"]) >= 220 ? 
                substr($course["course_description"], 0, 220) . "....." :
                $course["course_description"] ?>
              </p>
            </div>
            <div class="course-price" dir="rtl"><h3> <?php echo $course["course_price"]?> $ </h3></div>
          </div>
        </a>

      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

</div>

</main>

<!-- Footer Start -->
<?php include "./views/partials/footer.php" ?>
<!-- Footer End -->

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>