<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

  // checking user eligibility
  // - user trying to access admin side.
  is_admin();


$query =
" SELECT *
  FROM users u RIGHT OUTER JOIN payments p
    ON u.user_id = p.user_id
  ORDER BY payment_id DESC
";
$payments = select($query);

//--------------------------------------------
//# Getting admin payments view
require "views/admin/payments-show.view.php";
//--------------------------------------------


// ====================================
// # POST Request (approve payment)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["approve"])):

  $payment_id = $_POST["payment_id"];
  
  $query =
  " UPDATE payments
    SET payment_status = 1
    WHERE payment_id = $payment_id
  ";
  $sql->query($query);

  // getting user id of the payment
  $query =
  " SELECT user_id FROM payments
    WHERE payment_id = $payment_id
  ";
  $user_id = select($query)[0]["user_id"];

  // getting paid courses by user
  $query =
  " SELECT course_id
    FROM payments p JOIN payment_courses pc
      ON p.payment_id = pc.payment_id
    WHERE p.payment_id = $payment_id
  ";
  $user_courses = select($query);

  // inserting courses to users courses table
  foreach ($user_courses as $key => $course) {
    $course_id = $course["course_id"];
    $query =
    " INSERT INTO users_courses (user_id, course_id)
      VALUES ($user_id, $course_id)
    ";
    $sql->query($query);
  }

  notify("Payment Approved Successfully.");
  redirect("/admin/payments");

endif;


// ====================================
// # POST Request (reject payment)
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["reject"])):

  $payment_id = $_POST["payment_id"];

  $query =
  " UPDATE payments
    SET payment_status = 0
    WHERE payment_id = $payment_id
  ";
  $sql->query($query);
  notify("Payment Rejected Successfully.");
  redirect("/admin/payments");

endif;


$sql->close();
?>