<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Instructors | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/all-instructors.css">
</head>
<body>


<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<main>

<div id="instructors">
  <div id="instructors-title"> <h1>All Instructors</h1> </div>

  <?php foreach ($rows_of_instructors as $key => $instructors): ?>    
    <div class="instructors-container">
    <?php foreach ($instructors as $key => $instructor): ?>
      <a class="instructor-box" href="/all-instructors/<?=$instructor['instructor_id']?>">
      <!-- <a class="instructor-box" href="#"> -->
        <div class="instructor-info-container">
          <div class="instructor-img">
            <?php 
              $id = $instructor['instructor_id'];
              if ( file_exists("uploads/instructors/$id") ) {
                $img = glob("uploads/instructors/$id/image_$id.*")[0];
            ?>
              <img src="/<?=$img?>" alt="">
            <?php } ?>
          </div>
          <div class="instructor-info">
            <p> <?=$instructor['instructor_title']?> </p>
            <h2> <?=$instructor['instructor_full_name']?> </h2>
            <p> <?=$instructor['instructor_years_of_experience']?> years of experience</p>
          </div>
        </div>
        <div class="instructor-bio">
          <p> <?php
            // limiting number of displayed characters of course name
            echo strlen($instructor["instructor_bio"]) >= 43 ? 
            substr($instructor["instructor_bio"], 0, 43) . "..." :
            $instructor["instructor_bio"] ?>
          </p>
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