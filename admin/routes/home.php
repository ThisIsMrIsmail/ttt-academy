<?php

require "db.php";

// ====================================
// # GET Request
// ====================================

// getting 3 courses for the home page

$query = 
" SELECT *
  FROM courses
  LIMIT 3
";
$courses = select($query);

// getting our statistics
$users_count = select("SELECT COUNT(user_id) as count FROM users")[0]["count"];
$courses_count = select("SELECT COUNT(course_id) as count FROM courses")[0]["count"];
$instructors_count = select("SELECT COUNT(instructor_id) as count FROM instructors")[0]["count"];


//------------------------------------
// # Getting course view
require "views/user/home.view.php";
//------------------------------------

$sql->close();

?>