<?php


// go to route function to handle routes
function goToRoute($route) {
  global $routes;
  if ( array_key_exists($route, $routes) ) {
    require __DIR__ . $routes[$route];
  } else {
    abort();
  }
}


// abort function for page not found
function abort($code=404) {
  http_response_code($code);
  require "views/404.php";
  die();
}


// checks if admin is logged in or not to manage
// user eligibility and not reach admin side
function is_admin() {
  if ( ! isset($_SESSION["admin_username"]) )
    redirect("/login");
}


// select function to create select statement and reduce lines of code
function select($query) {
  $sql = new mysqli(
    $_ENV["HOST"],
    $_ENV["USERNAME"],
    $_ENV["PASSWORD"],
    $_ENV["DATABASE_NAME"],
    $_ENV["PORT"]
  );
  $result = $sql->query($query);
  $output = [];
  for ($i=0; $i < $result->num_rows; $i++) { 
    array_push( $output, $result->fetch_assoc() );
  }
  return $output;
}


// echo and die function
function echodie($var) {
  if ( gettype($var) == "array")
    print_r($var);
  else
    print $var;
  die();
}


// using javascript createAlertMessage function
function notify($msg, $type=True) {
  if ( $type )
    echo("<script> createAlertMessage('$msg', 'success') </script>");
  else
    echo("<script> createAlertMessage('$msg', 'failure') </script>");
}


// using javascript redirect
function redirect($route, $sec=0) {
  echodie("
    <script>
      setTimeout(() => {
        window.location.href = '$route'
      }, $sec);
    </script>
  ");
}


// upload file function
function upload_file($file, $file_type, $dirname, $id, $need_date=false) {
  // target saving directory
  $target_dir = "uploads/$dirname/$id/";
  // getting file extension
  $file_ext = pathinfo($file["name"], PATHINFO_EXTENSION);
  // changing file name
  if ($file_type == "video") {
    $extension = "mp4";
  } else {
    $extension = "jpg";
  }
  $file["name"] = $file_type . "_$id." . $extension;

  // createing new date
  $date = date_format(date_create(), "Y-m-d h.m.s");
  if ( $need_date ) {
    $file["name"] = $file_type . "_{$id}_$date." . $extension;
  }

  // getting target file path + name
  $target_file = $target_dir . basename($file["name"]);
  // creating directory if not exists
  if ( ! file_exists($target_dir) ) {
    mkdir($target_dir);
  }

  // checking if uploaded file extension is allowed
  if (
    $file_ext != "jpg" && $file_ext != "png" && $file_ext != "jpeg" &&
    $file_ext != "mp4"
  ) {
    notify("Sorry, uploaded $file_type file extension is not allowed!");
    exit(notify("Sorry, your $file_type file was not uploaded!"));
  }
  // % I disabled this step because it already override the stored image
  // checking if the file already exists
  if ( file_exists($target_file) ) {
    unlink($target_file);
  }
  // if everything is ok, try to upload file
  $is_uploaded = move_uploaded_file($file["tmp_name"], $target_file);
  if ( ! $is_uploaded ) {
    exit(notify("Error uploading $file_type!"));
  }
  notify("Uploaded successfully!");
}


// delete directory function
function delete_dir($id, $dirname) {
  $del_dir = "uploads/$dirname/$id";
  if ( file_exists($del_dir) ) {
    // getting a list of all of the file names in the dir to delete.
    $files = glob($del_dir . "/*");
    // lopping through the file list.
    foreach($files as $file) {
      unlink($file);
    }
    rmdir($del_dir);
  }
}


//#-----------------------------------
//# Send Verification Code function
//#-----------------------------------
//* getting PHPMailer Package

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

function send_verification() {
  require "db.php";
  $username = $_SESSION["unverified_username"];

  $user = select("SELECT * FROM users WHERE username = '$username'")[0];
  $user_id = $user["user_id"];
  $email = $user["user_email"];
  $name = $user["user_full_name"];

  // generating verification code
  $verification_code = substr( number_format(time() * rand(), 0, "", ""), 0, 6);

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

    $subject = "[Verify Your Account] TribleTAcademy Account";
    $message =
    "<!DOCTYPE html>
    <html>
    <head> <meta http-equiv='Content-Type' content='text/html charset=UTF-8'> </head>
    <body>
      <h1 style='font-weight: 500; color: gray;'>TribleTAcademy Account</h1>
      <p style='font-weight: 300; font-size: 40px; color: #4534b0;'>Verification Code</p>
      <p style='font-weight: 400; font-size: 16px;'>Hello $name,<br></p>
      <p style='font-weight: 400; font-size: 16px;'>Please use the following verification code for the TribleTAcademy account: $email.</p>
      <p style='font-weight: 400; font-size: 16px;'>Verification code: <b>$verification_code</b></p>
      <p style='font-weight: 400; font-size: 16px;'><br>Thanks,<br>The TribleTAcademy team</p>
    </body>
    </html>
    ";

    $mail->Subject = $subject;
    $mail->Body = $message;

    $is_sent = $mail->send();

    //#---------------------------------------
    //# updating verification code in database
    //#---------------------------------------
    $query =
    " UPDATE users
      SET user_verification_code = '$verification_code'
      WHERE user_id = $user_id
    ";
    $code_set = $sql->query($query);

    if ( $is_sent AND $code_set ) {
      sleep(1.5);
      notify("Verification Code sent to your email address successfully.");
    }

  } catch (Exception $e) {
    notify("Something went wrong, couldn\'t send verification code. Error: {$mail->ErrorInfo}");
  }
}

?>