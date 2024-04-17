<?php

require "db.php";


//------------------------------------
// # Getting course view
require "views/admin/login.view.php";
//------------------------------------


// ====================================
// # POST Request (login)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["submit"]) ):

  // getting POSTed data
  $account = $_POST['account'];
  $password = $_POST['password'];

  // getting all data of the admins
  $admins = select("SELECT * FROM admins");

  // handling if the submitted account info exist in the database
  $account_exists = 0;

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
    exit(notify("Wrong username, or Account does not Exist!", false));
  }

endif;

$sql->close();

?>