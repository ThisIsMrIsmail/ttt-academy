<?php

require "db.php";


// ====================================
// # GET Request
// ====================================
if ($_SERVER["REQUEST_METHOD"] == "GET"):

  // getting all instructors so user can select them
  $query = 
  " SELECT instructor_id, instructor_full_name, instructor_title
    FROM instructors;
  ";
  $instructors = select($query);

endif;

  
// ====================================
// # POST Request
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["save_button"]) ):

  // getting course POSTed Data
  $name = $_POST["course_name"];
  $price = $_POST["course_price"];
  $description = $_POST["course_description"];
  $instructor_id = 'NULL';
  if ( $_POST["instructor_id"] )
    $instructor_id = $_POST["instructor_id"];

  // inserting course's data
  $query = 
  " INSERT INTO courses (course_name, course_price, course_description, instructor_id)
    VALUES ('$name', $price, \"$description\", $instructor_id)
  ";
  $sql->query($query);  

  // getting last inserted course id
  $course_id = select( "SELECT MAX(course_id) as id FROM courses" )[0]["id"];

  // getting course POSTed Files
  $video = $_FILES["course_video"];
  $thumbnail = $_FILES["course_thumbnail"];

  // uploading course video and thumbnail
  if ( $video["name"] != "" )
    upload_file($video, "video", "courses", $course_id);
  if ( $thumbnail["name"] != "" )
    upload_file($thumbnail, "thumbnail", "courses", $course_id);
    

  // checking for POSTed levels
  if ( isset($_POST["levels"]) ) {
    // POSTed levels
    $levels = $_POST['levels'];
    
    // looping through POSTed levels
    foreach ($levels as $key => $level) {
      $name = $level["level_name"];
      $duration = $level["level_duration"];
      $description = $level["level_description"];
    
      // updating levels
      $query =
      " INSERT INTO levels (level_name, level_duration, level_description, course_id)
        VALUES ('$name', $duration, \"$description\", $course_id)
      ";
      $sql->query($query);
    }
  }

  // echodie("<script> window.location.href = '/admin/courses' </script>");
  exit(header("Location: /admin/courses"));

endif;

$sql->close();
require "./views/admin/courses-add.view.php";

?>