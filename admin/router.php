<?php

// Array of allowed routes
$routes = [

  "/"                 => "/routes/dashboard.php",
  "/login"            => "/routes/login.php",
  "/courses"          => "/routes/courses-show.php",
  "/courses/add"      => "/routes/courses-add.php",
  "/instructors"      => "/routes/instructors-show.php",
  "/instructors/add"  => "/routes/instructors-add.php",
  "/payments"         => "/routes/payments-show.php",
  "/transfer-number"  => "/routes/transfer-number.php",

];


// getting browser requested route
$uri = parse_url($_SERVER["REQUEST_URI"]);
$route = $uri["path"];

// breaking route into array with separator "/"
$route_to_array = explode("/", $route);

// handling IDs for each page to create retrive from database
if ( isset($route_to_array[3]) and $route_to_array[3] != "add") {
  $routes["/courses/$route_to_array[3]"]     = "/routes/courses-edit.php";
  $routes["/instructors/$route_to_array[3]"] = "/routes/instructors-edit.php";
  $routes["/payments/$route_to_array[3]"]    = "/routes/payments-payment.php";
}

// loading data for the route
goToRoute($route);