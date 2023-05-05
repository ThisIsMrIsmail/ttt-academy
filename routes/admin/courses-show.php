<?php

require "db.php";


// ===========================================================
// # GET Request
// ===========================================================
if ($_SERVER["REQUEST_METHOD"] == "GET"):

  $query = 
  " SELECT course_id, course_name, course_description, course_price
    FROM courses
  ";
  $courses = select($query);
  // creating dots for course description length more than or equal 50
  for ($i=0; $i < count($courses); $i++) {
    if ( strlen($courses[$i]["course_description"]) >= 50)
      $courses[$i]["course_description"] = substr($courses[$i]["course_description"], 0, 50) . "....";
  }

endif;


// ===========================================================
// # DELETE Request (delete course)
// ===========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" and  isset($_POST["remove"]) ):
    
  $course_id = $_POST["remove_course_id"];
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
  exit(header("Location: /admin/courses"));

endif;


$sql->close();
require "./views/admin/courses-show.view.php";
?>