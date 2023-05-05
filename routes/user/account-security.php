<?php

require "db.php";


// ====================================
// # GET Request
// ====================================
// if ($_SERVER["REQUEST_METHOD"] == "GET"):

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

// ------------------------------------
// # Getting account security view
require "./views/user/account-security.view.php";
// ------------------------------------
// endif;



// ====================================
// # POST Request (email Update)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["change_email"]) ):

  $user_id = $_SESSION["user_id"];

  $old_email = $_POST["old_email"];
  $new_email = $_POST["new_email"];

  $query =
  " SELECT user_email FROM users
    WHERE user_id = $user_id
  ";
  $email = select($query)[0]["user_email"];

  // checking if inserted old email is equal to email in database
  if ( $email != $old_email ) {
    echodie("<script> createAlertMessage('Wrong old email!', 'failure') </script>");
  }

  // checking if inserted new email is equal to old email
  if ( $new_email == $old_email ) {
    echodie("<script> createAlertMessage('You inserted the same email!', 'failure') </script>");
  }

  // getting all of users emails and checking if new email already exists
  $all_emails = select("SELECT user_email FROM users");
  foreach ($all_emails as $key => $email) {
    if ( $new_email == $email["user_email"]) {
      echodie("<script> createAlertMessage('Inserted new email already exists!', 'failure') </script>");
    }
  }

  // updating user email
  $query =
  " UPDATE users
    SET user_email = '$new_email'
    WHERE user_id = $user_id
  ";
  $sql->query($query);

  $_SESSION["user_email"] = $new_email;

  echo "<script> createAlertMessage('Email changed successfully.', 'success') </script>";
  echodie("<script> window.location.href = '/profile/account-security' </script>");

endif;

// ====================================
// # POST Request (email Update)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["change_password"]) ):

  $user_id = $_SESSION["user_id"];

  $old_password = $_POST["old_password"];
  $new_password = $_POST["new_password"];

  $query =
  " SELECT user_password FROM users
    WHERE user_id = $user_id
  ";
  $password = select($query)[0]["user_password"];

  // checking if inserted old password is equal to password in database
  if ( $password != $old_password ) {
    echodie("<script> createAlertMessage('Wrong old password!', 'failure') </script>");
  }

  // checking if inserted new password is equal to old password
  if ( $new_password == $old_password ) {
    echodie("<script> createAlertMessage('You inserted the same password!', 'failure') </script>");
  }

  // updating user email
  $query =
  " UPDATE users
    SET user_password = '$new_password'
    WHERE user_id = $user_id
  ";
  $sql->query($query);

  echo "<script> createAlertMessage('Password changed successfully.', 'success') </script>";
  echodie("<script> window.location.href = '/profile/account-security' </script>");

endif;

$sql->close();

?>