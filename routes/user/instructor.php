<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

// getting instructor id from route
global $route_to_array;
$instructor_id = $route_to_array[2];

// checking if instructor exists
$query = "SELECT instructor_id FROM instructors";
$result = select($query);
$instructor_exist = 0;
foreach ($result as $key => $instructor) {
  if ($instructor_id == $instructor["instructor_id"]) {
    $instructor_exist = 1;
  }
}

// course does not exist
if ( ! $instructor_exist ) abort();

// getting all of the instructor information
$query = 
" SELECT * FROM instructors
  WHERE instructor_id = $instructor_id";
$instructor = select($query)[0];

$query =
" SELECT course_id, course_name, course_description
  FROM courses
  WHERE instructor_id = $instructor_id
";
$courses = select($query);

// number of ceils we want to display in a row
$n_ceils = 3;
// number of rows we want to display in the page 
$n_rows = ceil( count($courses) / $n_ceils );
// output table courses
$rows_of_courses = [];
// temporary array for pushing
$tmp = [];

for ($i=0; $i < count($courses); $i++) {
  // pushing ceil of course array to tmp untill filling the row
  array_push($tmp, $courses[$i]);
  // row filled or end of courses
  if ( ($i+1) % $n_ceils == 0  or  ($i+1) == count($courses)) {
    // pushing row to the table of courses
    array_push($rows_of_courses, $tmp);
    // cleaning tmp for reuse
    $tmp = [];
  }
}


$sql->close();

require "./views/user/instructor.view.php";

?>