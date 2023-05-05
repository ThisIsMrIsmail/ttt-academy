<?php

require "db.php";
  
// ====================================
// # GET Request
// ====================================
$query = "SELECT * FROM courses";
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

// closing sql connection
$sql->close();

require "./views/user/all-courses.view.php"

?>