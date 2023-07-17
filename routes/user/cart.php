<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

// checking if the user is logged in
is_logged_in();


$user_id = $_SESSION["user_id"];
$query =
" SELECT co.course_id, course_name, course_description, course_price
  FROM courses co JOIN carts ca
    ON co.course_id = ca.course_id JOIN users u
    ON ca.user_id = u.user_id
  WHERE ca.user_id = $user_id
";

$courses = select($query);
$total_amount = 0;

for ($i=0; $i < count($courses); $i++) {
  $total_amount += $courses[$i]["course_price"];

  if ( strlen($courses[$i]["course_description"]) >= 90)
    $courses[$i]["course_description"] = substr($courses[$i]["course_description"], 0, 90) . "....";

  if ( strlen($courses[$i]["course_name"]) >= 25)
    $courses[$i]["course_name"] = substr($courses[$i]["course_name"], 0, 25) . "...";
}


//------------------------------------
// # Getting cart view
require "./views/user/cart.view.php";
//------------------------------------


// ====================================
// # DELETE Request
// ====================================
if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["remove_course_button"]) ):

  $user_id = $_SESSION["user_id"];
  $course_id = (int) $_POST["course_id"];

  $query =
  " DELETE FROM carts
    WHERE user_id = $user_id and course_id = $course_id
  ";
  $sql->query($query);

  notify("Course removed from cart successfully.");
  redirect("/cart");

endif;

$sql->close();

?>