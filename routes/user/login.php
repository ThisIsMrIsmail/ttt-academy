<?php

require "db.php";
require "views/user/login.view.php";

// ====================================
// # GET Request
// ====================================
if ($_SERVER["REQUEST_METHOD"] == "GET") {
}


// ====================================
// # POST Request
// ====================================
if (
  $_SERVER["REQUEST_METHOD"] == "POST" and 
  isset($_POST["submit"])
) {

  // getting POSTed data
  $account = $_POST['account'];
  $password = $_POST['password'];

  // getting all data of the users
  $query =
  " SELECT user_email, username, user_password
    FROM users";
  $users = select($query);

  // getting all data of the admins 
  $query =
  " SELECT admin_username, admin_password
    FROM admins";
  $admins = select($query);

  // handling if the submitted account info exist in the database
  $account_exist = 0;

  // looping through all users
  foreach ($users as $key => $user) {
    // account exists
    if ( $account === $user["user_email"] || $account === $user["username"] ) {
      $account_exist = 1;
      // checking for passowrd
      if ($password != $user["user_password"]) {
        echo "<script> createAlertMessage('Wrong Passowrd!', 'failure') </script>";
      } else {
        // checking if submitted account is email or username
        $is_email = filter_var($account, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
        if ( $is_email ) {
          $user = select("SELECT * FROM users WHERE user_email = '$account'");
        } else {
          $user = select("SELECT * FROM users WHERE username = '$account'");
        }
        // creating session for the user so we can use it later on the website
        $_SESSION["user_id"] = $user[0]["user_id"];
        $_SESSION["username"] = $user[0]["username"];
        $_SESSION["user_email"] = $user[0]["user_email"];
        exit(header("Location: /"));
      }
    }
  }

  // looping through all admins
  foreach ($admins as $key => $admin) {
    // account exists
    if ( $account == $admin["admin_username"] ) {
      $account_exist = 1;
      // checking for passowrd
      if ($password != $admin["admin_password"]) {
        echo "<script> createAlertMessage('Wrong Passowrd!', 'failure') </script>";
      } else {
        // creating session for the user so we can use it later on the website
        $_SESSION["admin_username"] = $account;
        exit(header("Location: /admin/dashboard"));
      }
    }
  }

  // account does not exist
  if ( ! $account_exist )
    echo "<script>
      createAlertMessage('Wrong Email or Username, or Account Does not Exist!', 'failure')
    </script>";


}
  
$sql->close();


?>