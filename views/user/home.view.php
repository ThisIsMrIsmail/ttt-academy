<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/home.css">
</head>

<body>
<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
  <section id="welcome-section">
    <div id="welcome">
      <div id="welcome-title"> <h1>Triple T academy</h1> </div>
      <div id="welcome-msg">
        <h2>Power your Dreams, Improve your life,<br> Get skilled, Try, Train, Transform</h2>
      </div>
      <?php if ( ! isset($_SESSION["username"])) { ?>
        <div class="get-started-btn get-started-btn-1"> <a href="/signup">Get Started</a> </div>
      <?php } ?>
    </div>
  </section>
  
  <section id="courses-section">
    <div id="courses">
      <div class="section-title"> <h2>Popular Courses</h2> </div>
      <div id="courses-container">
        <?php foreach ($courses as $key => $course) { ?>
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
            <div class="course-price" dir="rtl"><h3> <?=$course["course_price"]?>$ </h3></div>
          </div>
        </a>
        <?php } ?>
      </div>
    </div>
  </section>

  <section id="numbers-section">
    <div id="numbers">
      <div class="section-title"> <h2>Our Statistics</h2> </div>
      <div id="numbers-container">
        <div class="number students"><h2><?=$users_count?>+</h2><span>Students</span></div>
        <div class="number postive-reviews"><h2><?=$courses_count?>+</h2><span>Courses</span></div>
        <div class="number instructors"><h2><?=$instructors_count?>+</h2><span>Instructors</span></div>
      </div>
    </div>
  </section>

  <?php if ( !isset($_SESSION["username"])) { ?>
  <section id="get-started-section">
    <div id="get-started">
      <div id="get-started-msg">Sign up now for FREE.</div>
      <div class="get-started-btn get-started-btn-2"><a href="/signup">Get Started</a></div>
    </div>
  </section>
  <?php } ?>
</main>
<!-- Main End -->

<!-- Footer Start -->
<?php include "./views/partials/footer.php" ?>
<!-- Footer End -->


<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>