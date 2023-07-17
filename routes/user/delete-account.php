<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

  // checking if the user is logged in
  is_logged_in();
  
  $user_id = $_SESSION["user_id"];
  // getting user information
  $query =
  " SELECT * FROM users
    WHERE user_id = $user_id
  ";
  $user = select($query)[0];


//------------------------------------
// # Getting course view
require "./views/user/delete-account.view.php";
//------------------------------------


// ====================================
// # POST Request (DELETE)
// ====================================
if ($_SERVER["REQUEST_METHOD"] == "POST"  and  isset($_POST["delete"]) ):

  $user_id = $_POST["user_id"];

  delete_dir($user_id, "users");

  // setting user id to null for each payment
  $query =
  " UPDATE payments
    SET user_id = NULL
    WHERE user_id = $user_id
  ";
  $payments = select($query);

  // deleting user courses
  $query =
  " DELETE FROM users_courses
    WHERE user_id = $user_id
  ";
  $sql->query($query);

  // deleting user data
  $query =
  " DELETE FROM users
    WHERE user_id = $user_id
  ";
  $sql->query($query); 

  
  session_unset();
  session_destroy();
  session_start();

  // clearing localStorage (send and resend vf code)
  echo "<script> sessionStorage.clear(); </script>";


  notify("Account deleted successfully.");
  redirect("/");

endif;

$sql->close();

?>