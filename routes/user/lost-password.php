<?php

require "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";



// ====================================
// # POST Request
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["send_password"]) ):

  $email = $_POST["email"];
  
  // checking if account exists
  $query =
  " SELECT user_full_name FROM users
    WHERE user_email = '$email'
  ";
  $user = select($query);

  if ( ! $user ) {
    exit(notify("Wrong email address, or Account doesn\'t exist!", false));
  }


  //#------------------------
  //# GENERATING NEW PASSWORD
  //#------------------------
  // allowed characters
  $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$&*";
  // initializing new password
  $generated_password = "";
  // setting password length
  $generated_password_length = 12;
  // generating password
  for ($i=0; $i < $generated_password_length; $i++) {
    $num = rand(1, 9) * rand(10, 20) % strlen($characters);
    $generated_password .= $characters[$num];
  }

  //#-----------------------------------
  //# sending generated password to mail
  //#-----------------------------------
  try {
    $mail = new PHPMailer(true);

    // for showing debuging of the mail process
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.office365.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = $_ENV["TTT_SMTP_EMAIL"];
    $mail->Password = $_ENV["TTT_SMTP_EMAIL_PASSWORD"];

    $mail->setFrom($_ENV["TTT_SMTP_EMAIL"], $_ENV["TTT_SMTP_NAME"]);
    $mail->addAddress($email);
    $mail->isHTML(true);

    // getting the name of the user
    $name = $user[0]["user_full_name"];

    $subject = "[New Genegrated Password] TribleTAcademy Account";
    $message =
    "<!DOCTYPE html>
    <html>
      <head>
        <meta http-equiv='Content-Type' content='text/html charset=UTF-8'>
    </head>
    <body>
      <h1 style='font-weight: 500; color: gray;'>TribleTAcademy Account</h1>
      <p style='font-weight: 300; font-size: 40px; color: #4534b0;'>New Generated Password</p>
      <p style='font-weight: 400; font-size: 16px;'>Hello $name,<br></p>
      <p style='font-weight: 400; font-size: 16px;'>Please use the following password for the TribleTAcademy account: $email.</p>
      <p style='font-weight: 400; font-size: 16px;'>New Password: <b>$generated_password</b></p>
      <p style='font-weight: 400; font-size: 16px;'>
        Please make sure to edit this password in your TribleTAcademy account 
        security settings to keep your account safe and more secure.
      </p>
      <p style='font-weight: 400; font-size: 16px;'><br>Thanks,<br>The TribleTAcademy team</p>
    </body>
    </html>
    ";

    $mail->Subject = $subject;
    $mail->Body = $message;

    $is_sent = $mail->send();

    //#-----------------------------------
    //# updating user password in database
    //#-----------------------------------
    $query =
    " UPDATE users
      SET user_password = '$generated_password'
      WHERE user_email = '$email'
    ";
    $password_set = $sql->query($query);

    if ( $is_sent AND $password_set ) {
      notify("Password updated successfully.");
      notify("Mail sent to your email address successfully.");
    }

  } catch (Exception $e) {
    notify("Something went wrong, couldn\'t send mail or generate new password. Error: {$mail->ErrorInfo}");
  }


endif;

?>