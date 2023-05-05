<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instructor | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/instructor.css">
</head>
<body>

<?php include "./views/partials/header.php" ?>

<main>
<div id="instructor">

  <div id="instructor-info">
    <div id="instructor-left">
      <div id="instructor-top">
        <p> <?=$instructor["instructor_title"]?> </p>
        <h1> <?=$instructor["instructor_full_name"]?> </h1>
        <p> <?=$instructor["instructor_years_of_experience"]?> years of experience</p>
      </div>
      <div id="instructor-bio">
        <h2>About</h2>
        <p> <?=$instructor["instructor_bio"]?> </p>
      </div>
    </div>
    <div id="instructor-right">
      <div id="instructor-img">
        <?php

          $id = $instructor['instructor_id'];
          if ( file_exists("uploads/instructors/$id") ) {
            $img = glob("uploads/instructors/$id/image_$id.*")[0];

        ?>
          <img src="/<?=$img?>" alt="">
          <?php } else { ?>
          <img src="/src/partials/user-img/user-img-0.jpg" alt="">
        <?php } ?>
      </div>
      <div id="instructor-contacts">
        <div id="instructor-whatsapp">
          <a href="https://wa.me/<?=$instructor["instructor_contact_number"]?>" target="_blank"> <img src="/src/partials/svg/whatsapp.svg" alt=""> </a>
        </div>
        <div id="instructor-contact-no">
          <a href="tel:<?=$instructor["instructor_contact_number"]?>" target="_blank"> <img src="/src/partials/svg/telephone-fill.svg" alt=""> </a>
        </div>
        <div id="instructor-email">
          <a href="mailto:<?=$instructor["instructor_email"]?>" target="_blank"> <img src="/src/partials/svg/envelope-fill.svg" alt=""> </a>
        </div>
      </div>
    </div>
  </div>

  <div id="courses">  
    <div id="courses-title"> <h2>Courses</h2> </div>
    
    <?php foreach ($rows_of_courses as $key => $courses): ?>
      <div class="courses-container">
        <?php foreach ($courses as $key => $course): ?>
          <a class="instructor-course" href="/all-courses/<?=$course['course_id']?>">
            <div class="course-content">
              <h2> <?php
                // limiting number of displayed characters of course name
                echo strlen($course["course_name"]) >= 30 ? 
                substr($course["course_name"], 0, 30) . "..." :
                $course["course_name"] ?> </h2>
              <p> <?php
                // limiting number of displayed characters of course description
                echo strlen($course["course_description"]) >= 60 ? 
                substr($course["course_description"], 0, 60) . "....." :
                $course["course_description"] ?> </p>
            </div>
          </a>
        <?php endforeach; ?>
        
      </div>
    <?php endforeach; ?>
  </div>

</div>
</main>

<?php include "./views/partials/footer.php" ?>

<?php include "./views/partials/scripts.php" ?>
  
</body>
</html>