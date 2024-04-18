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
$instructor_id = $route_to_array[3];

// checking if course exists
$query = "SELECT instructor_id FROM instructors";
$result = select($query);
$IDs = [];
foreach ($result as $key => $instructor) {
  array_push($IDs, $instructor["instructor_id"]);
}
$instructor_exist = in_array($instructor_id, $IDs);

// course does not exist
if ( ! $instructor_exist )
  abort();

// getting instructor POSTed Data
$query =
" SELECT * FROM instructors
  WHERE instructor_id = $instructor_id
";
$instructor = select($query)[0];

$instructor_img = glob("uploads/instructors/$instructor_id/image_$instructor_id.*");

//------------------------------------
// # Getting instructors view
require "./views/admin/instructors-edit.view.php";
//------------------------------------

  
// ====================================
// # PUT Request
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["save_button"]) ):

  // getting instructor POSTed Data
  $instructor_id = $_POST["instructor_id"];
  $name = $_POST["instructor_name"];
  $title = $_POST["instructor_title"];
  $email = $_POST["instructor_email"];
  $contact_no = $_POST["instructor_contact_number"];
  $years_of_exp = $_POST["instructor_years_of_exp"];
  $bio = $_POST["instructor_bio"];

  // getting instructor POSTed File
  $instructor_img = $_FILES["instructor_img"];

  // uploading instructor image
  if ( $instructor_img["name"] != "" )
    upload_file($instructor_img, "image", "instructors", $instructor_id);

  $query =
  " UPDATE instructors
    SET instructor_full_name = '$name',
    instructor_title = '$title',
    instructor_email = '$email',
    instructor_contact_number = '$contact_no',
    instructor_years_of_experience = $years_of_exp,
    instructor_bio = \"$bio\"
    WHERE instructor_id = $instructor_id
  ";
  $sql->query($query);

  notify("Instructor data saved successfully.");
  redirect("/instructors/$instructor_id");

endif;

  
// ====================================
// # DELETE Request (delete instructor)
// ====================================
if (
  $_SERVER["REQUEST_METHOD"] == "POST" and
  $_POST["action"] == 'DELETE' and 
  isset($_POST["remove_instructor"])
):

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