<?php

require "db.php";
require "views/user/signup.view.php";
  

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
  isset($_POST['submit'])
) {

  // getting POSTed data
  $fullname = $_POST['fullname'];
  $username = strtolower($_POST['username']);
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
      echodie("<script> createAlertMessage('Username Already Exists!', 'failure') </script>");
    if ( $email == $user["user_email"] )
      echodie("<script> createAlertMessage('Email Already Exists!', 'failure') </script>");
  }

  // inserting submitted data to the database
  $query =
  " INSERT INTO users (user_full_name, username,user_email, user_password)
    VALUES ('$fullname', '$username', '$email', '$password')
  ";
  $sql->query($query);

  // redirecting to login page
  exit(header("Location: /login"));
}

// closing sql connection
$sql->close();


?>