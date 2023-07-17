<?php

// Array of allowed routes
$routes = [

  // # Home Route
  "/"                => "/routes/user/home.php",

  // # Admin Routes
  "/admin/dashboard"        => "/routes/admin/dashboard.php",
  "/admin/courses"          => "/routes/admin/courses-show.php",
  "/admin/courses/add"      => "/routes/admin/courses-add.php",
  "/admin/instructors"      => "/routes/admin/instructors-show.php",
  "/admin/instructors/add"  => "/routes/admin/instructors-add.php",
  "/admin/payments"         => "/routes/admin/payments-show.php",
  "/admin/transfer-number"  => "/routes/admin/transfer-number.php",

  // # Auth Routes
  "/signup"          => "/routes/user/signup.php",
  "/login"           => "/routes/user/login.php",
  // "/lost-password"   => "/routes/user/lost-password.php",
  // "/verify"          => "/routes/user/verify.php",
  "/logout"          => "/routes/user/logout.php",
  
  // # User Routes
  "/profile/profile-info"      => "/routes/user/profile-info.php",
  "/profile/profile-image"     => "/routes/user/profile-image.php",
  "/profile/account-security"  => "/routes/user/account-security.php",
  "/profile/delete-account"    => "/routes/user/delete-account.php",
  "/all-courses"     => "/routes/user/all-courses.php",
  "/all-instructors" => "/routes/user/all-instructors.php",
  "/instructor"      => "/routes/user/instructor.php",
  "/cart"            => "/routes/user/cart.php",
  "/checkout"        => "/routes/user/checkout.php",
  "/payments"        => "/routes/user/payments.php",
];


// getting browser requested route
$uri = parse_url($_SERVER["REQUEST_URI"]);
$route = $uri["path"];

// breaking route into array with separator "/"
$route_to_array = explode("/", $route);

// handling IDs for each page to create retrive from database
if ( isset($route_to_array[3]) and $route_to_array[3] != "add") {
  $routes["/admin/courses/$route_to_array[3]"]     = "/routes/admin/courses-edit.php";
  $routes["/admin/instructors/$route_to_array[3]"] = "/routes/admin/instructors-edit.php";
  $routes["/admin/payments/$route_to_array[3]"]    = "/routes/admin/payments-payment.php";
}
if ( isset($route_to_array[2]) ) {
  $routes["/all-courses/$route_to_array[2]"] = "/routes/user/course.php";
  $routes["/all-instructors/$route_to_array[2]"] = "/routes/user/instructor.php";
}

// loading data for the route
goToRoute($route);