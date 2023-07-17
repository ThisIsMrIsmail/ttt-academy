<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

  // checking user eligibility
  // - user trying to access admin side.
  is_admin();


  // getting course id from route
  global $route_to_array;
  $course_id = $route_to_array[3];

  // checking if course exists
  $query = "SELECT course_id FROM courses";
  $result = select($query);
  $IDs = [];
  foreach ($result as $key => $course) {
    array_push($IDs, $course["course_id"]);
  }
  $course_exist = in_array($course_id, $IDs);

  // course does not exist
  if ( ! $course_exist )
    abort();

  // getting all of the course information
  $query = 
  " SELECT * FROM courses
    WHERE course_id = $course_id";
  $course = select($query)[0];

  // getting course instructor information
  if ( $course["instructor_id"] ) {
    $instructor_id = $course["instructor_id"];
    $query =
    " SELECT * FROM instructors
      WHERE instructor_id = $instructor_id";
    $instructor = select($query)[0];
  }

  // getting all of the course's levels information
  $query = 
  " SELECT level_id, level_name, level_description, level_duration
    FROM courses c INNER JOIN levels l
    ON c.course_id = l.course_id
    WHERE c.course_id = $course_id
  ";
  $levels = select($query);

  // getting all files
  $course_video = glob("uploads/courses/$course_id/video_$course_id.*");
  $course_thumbnail = glob("uploads/courses/$course_id/thumbnail_$course_id.*");

  // getting course's instructor
  $query = 
  " SELECT instructor_id, instructor_full_name, instructor_title
    FROM instructors
  ";
  $instructors = select($query);

//-------------------------------------
// # Getting courses edit view
require "./views/admin/courses-edit.view.php";
//-------------------------------------


// ====================================
// # PUT Request (update course data)
// ====================================
if (
  $_SERVER["REQUEST_METHOD"] == "POST" and
  $_POST["action"] == 'PUT' and
  isset($_POST["save_button"])
):
  
  // getting course POSTed Data
  $course_id = $_POST["course_id"];
  $name = $_POST["course_name"];
  $price = $_POST["course_price"];
  $description = $_POST["course_description"];
  $instructor_id = 'NULL';
  if ( $_POST["instructor_id"] )
    $instructor_id = $_POST["instructor_id"];


  // updating course's data
  $query = 
  " UPDATE courses
    SET course_name = '$name',
    course_price = $price,
    course_description = \"$description\",
    instructor_id = $instructor_id
    WHERE course_id = $course_id
  ";
  $sql->query($query);
  
  // getting course POSTed Files
  $video = $_FILES["course_video"];
  $thumbnail = $_FILES["course_thumbnail"];

  // uploading course video and thumbnail
  if ( $video["name"] != "" )
    upload_file($video, "video", "courses", $course_id);
  if ( $thumbnail["name"] != "" )
    upload_file($thumbnail, "thumbnail", "courses", $course_id);


  // deleting all existing levels: easier than updating them
  /**
   * - NO POSTED levels
   *   -> means the admin removed all of the levels from the website
   * - POSTED levels
   *   -> means we are going to update levels data so we are going
   *   to delete the old levels and insert new ones
   */
  $query =
  " DELETE FROM levels
    WHERE course_id = $course_id
  ";
  $sql->query($query);

  // checking for POSTed levels
  if ( isset($_POST["levels"]) ) {
    $levels = $_POST["levels"];

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

  notify("Course data saved successfully.");
  redirect("/admin/courses/$course_id");
  
endif;
  
  
// ====================================
// # DELETE Request (delete course)
// ====================================
if (
  $_SERVER["REQUEST_METHOD"] == "POST" and
  $_POST["action"] == 'DELETE' and
  isset($_POST["remove_course"])
):

  $course_id = $_POST["course_id"];

  // checking if course is in users cart
  $query =
  " SELECT count(cart_id) as count
    FROM carts
    WHERE course_id = $course_id
  ";
  if ( select($query)[0]["count"] ) {
    exit(notify("Course can\'t be deleted, Course exists in Users\' Carts", false));
  }

  // checking if course is in  payment_courses and payments
  // table where payment status is pending
  $query =
  " SELECT COUNT(course_id) as count
    FROM payments p JOIN payment_courses pc
      ON p.payment_id = pc.payment_id
    WHERE payment_status = 2 AND course_id = $course_id;
  ";
  if ( select($query)[0]["count"] ) {
    exit(notify("Course can\'t be deleted, course exists in Pending Users\' Payments", false));
  }

  // deleting course's levels
  $query =
  " DELETE FROM levels
    WHERE course_id = $course_id
  ";
  $sql->query($query);

  // deleting course folder
  delete_dir($course_id, "courses");

  // deleting course
  $query =
  " DELETE FROM courses
    WHERE course_id = $course_id
  ";
  $sql->query($query);

  notify("Course removed successfully.");
  redirect("/admin/courses");

endif;


// closing sql connection
$sql->close();

?>