<?php

require "db.php";

// ====================================
// # GET Request
// ====================================

// getting course id from route
global $route_to_array;
$course_id = $route_to_array[2];

// checking if course exists
$query = "SELECT course_id FROM courses";
$result = select($query);
$course_exist = 0;
foreach ($result as $key => $course) {
  if ($course_id == $course["course_id"]) {
    $course_exist = 1;
  }
}

// course does not exist
if ( ! $course_exist ) abort();

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

// creating dots for course description length more than or equal 50
if ( strlen($course["course_description"]) >= 330) {
  $course["course_mini_description"] = substr($course["course_description"], 0, 330) . "....";
} else {
  $course["course_mini_description"] = $course["course_description"];
}

// getting all of the course's levels information
$query = 
" SELECT level_id, level_name, level_description, level_duration
  FROM courses c INNER JOIN levels l
  ON c.course_id = l.course_id
  WHERE c.course_id = $course_id
";
$levels = select($query);

if ( $levels ) {
  $course["course_duration"] = 0;
  foreach ($levels as $key => $level) {
    $course["course_duration"] += $level["level_duration"];
  }
}

// getting all files
$course_video = glob("uploads/courses/$course_id/video_$course_id.*");
$course_thumbnail = glob("uploads/courses/$course_id/thumbnail_$course_id.*");

//------------------------------------
// # Getting course view
require "views/user/course.view.php";
//------------------------------------


// ====================================
// # POST Request (Add Course to cart)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["add_to_cart"]) ):

  // checking if the user is logged in
  if ( ! isset($_SESSION["user_id"]) ) {
    notify("You are not logged in!", false);
    redirect("/login", 2);
  }

  // getting user id and course id
  $user_id = $_SESSION["user_id"];
  $course_id = $_POST["course_id"];

  // checking if course is paid or in pending state
  $query =
  " SELECT pc.payment_id
    FROM payments p JOIN payment_courses pc
      ON p.payment_id = pc.payment_id
    WHERE
      course_id = $course_id AND
      user_id = $user_id
  ";
  $payment_ids = select($query);

  foreach ($payment_ids as $key => $payment_id) {
    $id = $payment_id["payment_id"];
    $query =
    " SELECT payment_status FROM payments
      WHERE payment_id = $id
    ";
    $payment_status = (int) select($query)[0]["payment_status"];

    // payment status equal zero means payment was rejected
    // so we can enable user to submit new payment again.
    if ( $payment_status == 0)
      continue;
    // payment status equal one means that user already own the course
    elseif ( $payment_status == 1)
      exit(notify("You have already own this course!", false));
    // payment status equal two means that the course is in pending statge
    elseif ( $payment_status == 2)
      exit(notify("You have already paid this course and it\'s in the pending stage!", false));
  }

  // checking if the course already in cart
  $query = 
  " SELECT * FROM carts
    WHERE user_id = $user_id and course_id = $course_id
  ";
  $cart_course_exists = select($query);

  if ( ! $cart_course_exists ) {
    // adding course to cart table
    $query =
    " INSERT INTO carts (user_id, course_id)
      VALUES ($user_id, $course_id)
    ";
    $sql->query($query);
    notify("Course added to cart.");
  } else {
    notify("Course already in cart!", false);
  }
  redirect("/all-courses/$course_id");

endif;


// ====================================
// # POST Request (Buy Course)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["buy_now"]) ):
  
  // checking if the user is logged in
  if ( ! isset($_SESSION["user_id"]) ) {
    notify("You are not logged in!", false);
    redirect("/login", 2);
  }

  // getting user id and course id
  $user_id = $_SESSION["user_id"];
  $course_id = $_POST["course_id"];

  // checking if course is paid or in pending state
  $query =
  " SELECT payment_id FROM payment_courses
    WHERE course_id = $course_id
  ";
  $payment_ids = select($query);

  foreach ($payment_ids as $key => $payment_id) {
    $id = $payment_id["payment_id"];
    $query =
    " SELECT payment_status FROM payments
      WHERE payment_id = $id
    ";
    $payment_status = (int) select($query)[0]["payment_status"];
    
    // payment status equal zero means payment was rejected
    // so we can enable user to submit new payment again.
    if ( $payment_status == 0)
      continue;
    // payment status equal one means that user already own the course
    elseif ( $payment_status == 1)
      exit(notify("You have already own this course!", false));
    // payment status equal two means that the course is in pending statge
    elseif ( $payment_status == 2)
      exit(notify("You have already paid this course and it\'s in the pending stage!", false));
  }

  // checking if the 
  $query = 
  " DELETE FROM carts
    WHERE user_id = $user_id
  ";
  $sql->query($query);

  // adding course to cart table
  $query =
  " INSERT INTO carts (user_id, course_id)
    VALUES ($user_id, $course_id)
  ";
  $sql->query($query);

  notify("Course added to cart.");
  redirect("/cart");

endif;

$sql->close();

?>