<?php

require "db.php";


// ===========================================================
// # GET Request
// ===========================================================

  // checking user eligibility
  // - user trying to access admin side.
  is_admin();


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

//--------------------------------------------
// # Getting courses show view
require "./views/admin/courses-show.view.php";
//--------------------------------------------


// ===========================================================
// # DELETE Request (delete course)
// ===========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" and  isset($_POST["remove"]) ):
    
  $course_id = $_POST["remove_course_id"];

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

  // setting course id value equal to null  so the course can be
  // deleted as the foriegn key doesn't have access to courses table
  $query =
  " UPDATE payment_courses
    SET course_id = NULL
    WHERE course_id = $course_id
  ";
  $sql->query($query);

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
    WHERE course_id = $course_id;
  ";
  $sql->query($query);

  notify("Course removed successfully.");
  redirect("/admin/courses");

endif;


$sql->close();

?>