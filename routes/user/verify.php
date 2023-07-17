<?php

require_once "db.php";


// ======================================
// # POST Request (verification) [VERIFY]
// ======================================

if ( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["verify"]) ):
  
  // getting submitted vf code
  $vf_code = $_POST["vf_code"];
  // getting username from the session
  $username = $_SESSION["unverified_username"];
  
  // getting real vf code
  $query =
  " SELECT * FROM users
    WHERE username = '$username'
  ";
  $user = select($query)[0];
  $real_vf_code = $user["user_verification_code"];

  // checking if both are equal or not
  if ( $vf_code !== $real_vf_code ) {
    notify("Wrong Verification Code!", false);
    //------------------------------------
    // # Getting verification view dialog
    echodie("<script> dialogVerifiyDialog.showModal() </script>");
    //------------------------------------
  }
  
  //*---------------
  //* USER VERIFIED
  //*---------------
  $query =
  " UPDATE users
    SET user_verified = 1
    WHERE username = '$username'
  ";
  $sql->query($query);
  
  // destroying session to make sure that admin is logged out.
  session_unset();
  session_start();
  // creating session for the user so we can use it later on the website
  $_SESSION["user_id"] = $user["user_id"];
  $_SESSION["username"] = $user["username"];
  $_SESSION["user_email"] = $user["user_email"];

  notify("Account Verified Successfully.");
  redirect("/", 1.5);

endif;



// ======================================
// # POST Request (verification) [RESEND]
// ======================================

if ( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["resend"]) ):

  notify("Sending your Verification Code....");
  send_verification();
  //------------------------------------
  // # Getting verification view dialog
  echodie("<script> dialogVerifiyDialog.showModal() </script>");
  //------------------------------------

endif;

?>