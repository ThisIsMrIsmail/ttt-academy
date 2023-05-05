<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/admin/css/dashboard.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/admin-header.php" ?>
<!-- Header End -->


<!-- Main Start -->
<main>
  <div id="dashboard">
    <div id="dashboard-top">
      <h1 id="dashboard-title">Dashboard</h1>
    </div>
    <div class="links">
      <a class="link" id="courses" href="/admin/courses"> <div> <p>Courses</p> </div> </a>
      <a class="link" id="instructors" href="/admin/instructors"> <div> <p>Instructors</p> </div> </a>
    </div>
    <div class="links">
      <a class="link" id="payments" href="/admin/payments"> <div> <p>Payments</p> </div> </a>
      <a class="link" id="transfer-number" href="/admin/transfer-number"> <div> <p>Transfer Number</p> </div> </a>
    </div>
  </div>
</main>


<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>