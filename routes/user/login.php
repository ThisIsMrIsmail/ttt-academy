<?php

require "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";


//------------------------------------
// # Getting course view
require "views/user/login.view.php";
//------------------------------------

// ====================================
// # POST Request (verification)
// ====================================
// Handleing Verification Requests
require "routes/user/verify.php";


// ====================================
// # POST Request (lost password)
// ====================================
// Handleing Lost Password Requests
require "routes/user/lost-password.php";



// ====================================
// # POST Request (login)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["submit"]) ):

  // getting POSTed data
  $account = $_POST['account'];
  $password = $_POST['password'];

  // getting all data of the users;
  $users = select("SELECT * FROM users");

  // getting all data of the admins
  $admins = select("SELECT * FROM admins");

  // handling if the submitted account info exist in the database
  $account_exists = 0;

  // looping through all users
  foreach ($users as $key => $user) {
    // account exists
    if ( $account === $user["user_email"] || $account === $user["username"] ) {
      $account_exists = 1;
      // checking for passowrd          
      if ($password != $user["user_password"]) {
        exit(notify("Wrong Password!", false));
      }
      else {
        // checking if account is verified or not
        if ( ! $user["user_verified"] ) {
          // setting a session variable to verify user
          $_SESSION["unverified_username"] = $user["username"];
          // sending verification code
          print("<script> createAlertMessage('Account is not Verified.', 'warning') </script>");
          echodie("<script> dialogVerifiyDialog.showModal() </script>");
        }

        // user verified deleted
        unset($_SESSION["unverified_username"]);

        // unsetting admin session to make sure that admin is logged out.
        unset($_SESSION["admin_username"]);
        // creating session for the user so we can use it later on the website
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["user_email"] = $user["user_email"];
        redirect("/");
      }
    }
  }

  // looping through all admins
  foreach ($admins as $key => $admin) {
    // account exists
    if ( $account == $admin["admin_username"] ) {
      $account_exists = 1;
      // checking for passowrd
      if ($password != $admin["admin_password"]) {
        exit(notify("Wrong Password!", false));
      } else {
        // unsetting user sessions to make sure that user is logged out.
        unset($_SESSION["user_id"]);
        unset($_SESSION["username"]);
        unset($_SESSION["user_email"]);
        // creating session for the user so we can use it later on the website
        $_SESSION["admin_username"] = $account;
        redirect("/admin/dashboard");
      }
    }
  }

  // account does not exist
  if ( ! $account_exists ) {
    exit(notify("Wrong Email or Username, or Account Does not Exist!", false));
  }

endif;

$sql->close();

?>