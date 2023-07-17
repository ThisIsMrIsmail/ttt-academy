<?php

require "db.php";


// ====================================
// # GET Request
// ====================================
$query = "SELECT * FROM instructors";
$instructors = select($query);

// number of ceils we want to display in a row
$n_ceils = 3;
// number of rows we want to display in the page 
$n_rows = ceil( count($instructors) / $n_ceils );
// output table instructors
$rows_of_instructors = [];
// temporary array for pushing
$tmp = [];

for ($i=0; $i < count($instructors); $i++) {

  // pushing ceil of instructor array to tmp untill filling the row
  array_push($tmp, $instructors[$i]);
  // row filled or end of instructors
  if ( ($i+1) % $n_ceils == 0  or  ($i+1) == count($instructors)) {
    // pushing row to the table of instructors
    array_push($rows_of_instructors, $tmp);
    // cleaning tmp for reuse
    $tmp = [];
  }

}

//------------------------------------
// # Getting course view
require "./views/user/all-instructors.view.php";
//------------------------------------

$sql->close();

?>