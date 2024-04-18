<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

  // checking user eligibility
  // - user trying to access admin side.
  is_admin();


  $query = 
  " SELECT
      instructor_id, instructor_full_name, instructor_title,
      instructor_email, instructor_years_of_experience
    FROM instructors
  ";
  $instructors = select($query);


//--------------------------------------
// # Getting instructors show view
require "./views/admin/instructors-show.view.php";
//--------------------------------------


// ====================================
// # DELETE Request
// ====================================
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["remove"]) ):

  $instructor_id = $_POST["instructor_id"];

  // setting course instructor_id to NULL
  $query =
  " UPDATE courses
    SET instructor_id = NULL
    WHERE instructor_id = $instructor_id
  ";
  $sql->query($query);
  
  delete_dir($instructor_id, "instructors");

  $query =
  " DELETE FROM instructors
    WHERE instructor_id = $instructor_id
  ";
  $sql->query($query);

  notify("Instructor removed successfully.");
  redirect("/instructors");

endif;

$sql->close();

?>