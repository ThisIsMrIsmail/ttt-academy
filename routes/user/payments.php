<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

// checking if the user is logged in
is_logged_in();
  
$user_id = $_SESSION["user_id"];

// getting all of user payments
$query =
" SELECT * FROM payments
  WHERE user_id = $user_id
";
$payments = select($query);

// getting selected paid courses for each payment
$payment_courses = [];

// appending courses to payment_courses array
foreach ($payments as $key => $payment) {
  $payment_id = $payment["payment_id"];
  $query =
  " SELECT * FROM payment_courses
    WHERE payment_id = $payment_id";
  array_push($payment_courses, select($query));
}

// reversing the arrays so that lastest payments
// displayed at the top
$payments = array_reverse($payments);
$payment_courses = array_reverse($payment_courses);

//-------------------------------------
// # Getting payments view
require "./views/user/payments.view.php";
//-------------------------------------

$sql->close();

?>