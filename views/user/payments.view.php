<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payments | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/payments.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
<form action="" method="POST">
<!-- make DELETE Request -->

<div id="payments">
  <div id="payments-top">
    <h1 id="payments-title">My Payments</h1>
  </div>

  <table>
    <thead>
      <tr id="table-titles">
        <th> <h4>#</h4> </th>
        <th> <h4>Your Transfer Number</h4> </th>
        <th> <h4>Academy Transfer Number</h4> </th>
        <th> <h4>Payment Date</h4> </th>
        <th> <h4>Paid Amount</h4> </th>
        <th> <h4>Status</h4> </th>
      </tr>
    </thead>
    <tbody>

    <?php if ( ! $payments ) { ?>
      <tr> <td colspan="6"> <h2>You didn't make any payments</h2> </td> </tr>
    <?php } ?>

    <?php for ($i=0; $i < count($payments); $i++) { ?>
      <tr class="table-row">
        <td> <p> <?=$i+1?> </p> </td>
        <td> <p> <?=$payments[$i]["payment_transfer_number"]?> </p> </td>
        <td> <p> <?=$payments[$i]["payment_platform_transfer_number"]?> </p> </td>
        <td> <p> <?=$payments[$i]["payment_action_date"]?> </p> </td>
        <td> <p style="min-width: 100px;"> <?=$payments[$i]["payment_total_paid_amount"]?> $</p> </td>
      <?php if ( $payments[$i]["payment_status"] == 0 ): ?>
        <td> <p class="status rejected">Rejected <img src="/src/partials/svg/check-false.svg" alt=""></p> </td>
      <?php elseif ( $payments[$i]["payment_status"] == 1 ): ?>
        <td> <p class="status approved">Approved <img src="/src/partials/svg/check-true.svg" alt=""></p> </td>
      <?php elseif ( $payments[$i]["payment_status"] == 2 ): ?>
        <td> <p class="status pending">Pending <img src="/src/partials/svg/clock.svg" alt=""></p> </td>
      <?php endif; ?>
      </tr>
      <tr>
        <td colspan="6">
        <?php $courses = $payment_courses[$i] ?>
        <h3>Paid Courses:</h3>
        <?php foreach ($courses as $key => $course) { ?>
          <p> <?=$key+1?>: &nbsp; [ <?=$course["course_price"]?>$ ] &nbsp; [ <?=$course["course_name"]?> ] </p>
        <?php } ?>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

</form>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>