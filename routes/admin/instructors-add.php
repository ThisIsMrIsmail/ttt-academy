<?php

require "db.php";


// ====================================
// # GET Request
// ====================================


//-------------------------------------
// # Getting instructor view
require "./views/admin/instructors-add.view.php";
//-------------------------------------

  
// ====================================
// # POST Request
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["save_button"]) ):

  // getting instructor POSTed Data
  $name = $_POST["instructor_name"];
  $title = $_POST["instructor_title"];
  $email = $_POST["instructor_email"];
  $contact_no = $_POST["instructor_contact_number"];
  $years_of_exp = $_POST["instructor_years_of_exp"];
  $bio = $_POST["instructor_bio"];

  
  // getting all instructors' emails inside the database
  $query =
  " SELECT instructor_email, instructor_contact_number
    FROM instructors";
  $instructors = select($query);

  // checking if submitted email and contact number already exist
  foreach ($instructors as $key => $instructor) {
    if ( $email == $instructor["instructor_email"])
      echodie("<script> createAlertMessage('Instructor Email Already Exists!', 'failure') </script>");
    if ( $contact_no == $instructor["instructor_contact_number"])
      echodie("<script> createAlertMessage('Instructor Contact Number Already Exists!', 'failure') </script>");
  }

  // inserting instructor's data
  $query = 
  " INSERT INTO instructors (
      instructor_full_name, instructor_title, instructor_email,
      instructor_contact_number, instructor_bio, instructor_years_of_experience
    )
    VALUES ('$name', '$title', '$email', '$contact_no', \"$bio\", '$years_of_exp')
  ";
  $sql->query($query);

  // getting last inserted instructor id
  $instructor_id = select( "SELECT MAX(instructor_id) as id FROM instructors" )[0]["id"];

  // getting instructor POSTed File
  $instructor_img = $_FILES["instructor_img"];

  // uploading instructor image
  if ( $instructor_img["name"] != "" )
    upload_file($instructor_img, "image", "instructors", $instructor_id);

  echodie("<script> window.location.href = '/admin/instructors'</script>");

endif;


$sql->close();

?>