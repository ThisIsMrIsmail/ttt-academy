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

require "./views/user/delete-account.view.php";



// ====================================
// # POST Request (DELETE)
// ====================================
if ($_SERVER["REQUEST_METHOD"] == "POST"  and  isset($_POST["delete"]) ):

  $user_id = $_POST["user_id"];

  // echodie($_POST);

  delete_dir($user_id, "users");

  $query =
  " DELETE FROM users_courses
    WHERE user_id = $user_id
  ";
  $sql->query($query);

  $query =
  " DELETE FROM users
    WHERE user_id = $user_id
  ";
  $sql->query($query); 

  session_destroy();
  session_start();

  echo "<script> createAlertMessage('Account Deleted successfully.', 'success') </script>";
  echodie("<script> window.location.href = '/' </script>");

endif;

?>