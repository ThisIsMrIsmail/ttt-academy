<?php

require "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

//------------------------------------
// # Getting course view
require "views/user/signup.view.php";
//------------------------------------


// ====================================
// # POST Request (verification)
// ====================================
// Handleing Verification Requests
require "routes/user/verify.php";


// ====================================
// # POST Request
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['submit']) ):

  // getting POSTed data
  $fullname = $_POST['fullname'];
  $username = strtolower($_POST['username']);
  $age = $_POST['age'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // getting all users inside the database
  $query =
  " SELECT username, user_email
    FROM users
  ";
  $users = select($query);

  // checking if submitted email and username already exist
  foreach ($users as $key => $user) {
    if ( $username == $user["username"])
      exit(notify("Username Already Exists!", false));
    if ( $email == $user["user_email"] )
      exit(notify("Email Already Exists!", false));
  }

  // inserting submitted data to the database
  $query =
  " INSERT INTO users (user_full_name, username, user_age, user_email, user_password, user_verified)
    VALUES ('$fullname', '$username', '$age', '$email', '$password', 0)
  ";
  $sql->query($query);
  
  notify("Account created successfully.");
  
  //%--------------------------------
  //% Verification of created account
  //%--------------------------------
  // setting a session variable to verify user
  $_SESSION["unverified_username"] = $username;
  // sending verification code
  print("<script> createAlertMessage('Account should be verified.', 'warning') </script>");
  //------------------------------------
  // # Getting verification view dialog
  echodie("<script> dialogVerifiyDialog.showModal() </script>");
  //------------------------------------

endif;

?>