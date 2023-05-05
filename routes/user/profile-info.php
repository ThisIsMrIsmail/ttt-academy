<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

  // checking if the user is logged in
  if ( isset($_SESSION["user_id"]) ) {
    $user_id = $_SESSION["user_id"];
    // getting user information
    $query =
    " SELECT * FROM users
      WHERE user_id = $user_id
    ";
    $user = select($query)[0];
  } else {
    exit(header("Location: /login"));
  }

require "./views/user/profile-info.view.php";



// ====================================
// # POST Request (PUT)
// ====================================
if ($_SERVER["REQUEST_METHOD"] == "POST"  and  isset($_POST["save"]) ):

  $user_id = $_SESSION["user_id"];

  $name = $_POST["fullname"];
  $age = $_POST["age"];
  $contact_no = $_POST["contact_number"];
  $bio = $_POST["bio"];

  $query =
  " UPDATE users
    SET user_full_name = '$name',
    user_age = '$age',
    user_contact_number = '$contact_no',
    user_bio = '$bio'
    WHERE user_id = $user_id
  ";
  $sql->query($query);
  echodie("<script> 
    createAlertMessage('Data Saved Successfully.','success')
    window.location.href = '/profile/profile-info'
  </script>");


endif;

?>