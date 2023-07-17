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
require "./views/user/profile-info.view.php";
//------------------------------------


// ====================================
// # POST Request (PUT)
// ====================================
if ($_SERVER["REQUEST_METHOD"] == "POST"  and  isset($_POST["save"]) ):

  $user_id = $_SESSION["user_id"];

  $name = $_POST["fullname"];
  $contact_no = $_POST["contact_number"];
  $bio = $_POST["bio"];

  $query =
  " UPDATE users
    SET user_full_name = '$name',
    user_contact_number = '$contact_no',
    user_bio = '$bio'
    WHERE user_id = $user_id
  ";
  $sql->query($query);

  notify("Data saved successfully.");
  redirect("/profile/profile-info");

endif;

$sql->close();

?>