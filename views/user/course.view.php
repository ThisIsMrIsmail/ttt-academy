<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?=$course["course_name"]?> | TTT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/course.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
  <div id="course-title">
    <div id="course-title-description">
      <h1> <?=$course["course_name"]?> </h1>
      <p> <?=$course["course_mini_description"]?> </p>
    </div>
    <div id="course-video">
      <?php if ( $course_video ): ?>
          <video width="420" height="236" loop muted controlslist="nodownload" controls="controls" preload="auto"
          <?php if ( $course_thumbnail ) ?>
            poster="/<?=$course_thumbnail[0]?>"
          <!-- video closing tag -->
            >
            <source src="/<?=$course_video[0]?>" type="video/mp4">
          </video>
      <?php else: ?>
          <video width="420" height="236" src=""></video>
      <?php endif; ?>
      <p>Preview this course</p>
    </div>
  </div>
  <div id="course-content">
    <div id="course-content-details-info">
      <div id="course-content-details">
        <div class="details">
          <h2 class="details-heading">What you'll learn</h2>
          <?php for ($i=0; $i < count($levels); $i++) { ?>
            <div class="course-levels">
              <div class="level-title">
                <p> <?=$levels[$i]["level_name"]?> 
                  <span>(level <?=$i+1?>) (<?=$levels[$i]["level_duration"]?>hr)</span>
                </p>
              </div>
              <p> <?=$levels[$i]["level_description"]?> </p>
            </div>
          <?php } ?>
        </div>
        <div class="details">
          <h2 class="details-heading">Description</h2>
          <p> <?=$course["course_description"]?> </p>
        </div>
      </div>
      <div id="course-instructor">
        <h2>Instructor</h2>
        <?php if ( isset($instructor) ) { ?>
          <a href="/all-instructors/<?=$instructor['instructor_id']?>">
            <div id="instructor-info">
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
              <div id="instructor-name-title">
                <h3> <?=$instructor["instructor_full_name"]?> </h3>
                <p> <?=$instructor["instructor_title"]?> </p>
              </div>
            </div>
          </a>
        <?php } else { ?>
          <div id="instructor-info"> <h2> No Instructor </h2> </div>
        <?php } ?>
      </div>
    </div>
    <div id="course-payment">
      <h1>Price: <span id="price"> <?=$course["course_price"]?> $</span></h1>
      <?php if ( isset($course["course_duration"]) ) { ?>
        <h2>Duration: <span id="duration"> <?=$course["course_duration"]?> hours</span></h2>
      <?php } ?>
      <form action="" method="POST">
        <input type="hidden" name="course_id" value="<?=$course['course_id']?>">
        <div id="add-to-cart"> <button name="add_to_cart" type="sumbit">Add to cart</button> </div>
        <div id="buy-now"> <button name="buy_now" type="submit">Buy now</button> </div>
      </form>
    </div>
  </div>
</main>
<!-- Main Content End -->


<!-- Footer Start -->
<?php include "./views/partials/footer.php" ?>
<!-- Footer End -->


<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>