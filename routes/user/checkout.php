<?php

require "db.php";

// ====================================
// # GET Request
// ====================================

$user_id = $_SESSION["user_id"];
$query =
" SELECT course_price
  FROM courses co JOIN carts ca
    ON co.course_id = ca.course_id
  WHERE ca.user_id = $user_id
";
$courses = select($query);

$total_amount = 0;

foreach ($courses as $key => $course) {
  $total_amount += $course["course_price"];
}

$plat_trans_no = select("SELECT plat_trans_no FROM platform_transfar_numbers")[0]["plat_trans_no"];



//-------------------------------------
// # Getting checkout view
// require "views/user/checkout.view.php";
//-------------------------------------


// ====================================
// # POST Request (checkout)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["pay_button"]) ):

  $user_id = $_SESSION["user_id"];

  $platform_transfer_number = $_POST["platformTransferNumber"];
  $transfer_number = $_POST["transferNumber"];
  $operation_number = $_POST["operationNumber"];
  $total_amount = $_POST["total_amount"];

  $date = date_format(date_create(), "y-m-d");

  // payment status
  // - 2 -> pending
  // - 1 -> approved
  // - 0 -> rejected
  $query =
  " INSERT INTO payments (
    payment_status, payment_action_date, payment_platform_transfare_numbers,
    payment_transfer_number, payment_operation_number, payment_total_paid_amount, user_id
  )
  VALUES (
    2, '$date', '$platform_transfer_number', '$transfer_number',
    '$operation_number', $total_amount, $user_id
  )";
  $sql->query($query);

  // getting payment id
  $query =
  " SELECT payment_id
    FROM payments
    WHERE 
      payment_status = 2 AND
      payment_action_date = '$date' AND
      user_id = $user_id
  ";
  $IDs = select($query);
  $payment_id = $IDs[count($IDs) - 1]["payment_id"];
  
  // getting courses in cart
  $query = "SELECT course_id FROM carts WHERE user_id = $user_id";
  $cart_courses = select($query);
  
  // looping through courses in cart
  foreach ($cart_courses as $key => $cart_course) {
    $course_id = $cart_course["course_id"];
    $query =
    " INSERT INTO payment_courses (payment_id, course_id)
      VALUES ($payment_id, $course_id)
    ";
    $sql->query($query);
  }

  // deleting items in cart
  $query =
  " DELETE FROM carts
    WHERE user_id = $user_id
  ";
  $sql->query($query);
  
  // saving operation image
  $operation_image = $_FILES["operationImage"];
  upload_file($operation_image, "image", "payments", $user_id, true);

  echo "<script> createAlertMessage('Successful operation', 'success') </script>";
  echodie("<script> window.location.href = '/' </script>");

endif;


$sql->close();


require "views/user/checkout.view.php";
?>