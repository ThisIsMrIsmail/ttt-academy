<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payments | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/admin/css/payments-show.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/admin-header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
<form action="" method="POST">
<!-- make DELETE Request -->

<div id="payments">
  <div id="payments-top">
    <h1 id="payments-title">Payments</h1>
  </div>

  <table>
    <thead>
      <tr id="table-titles">
        <th> <h4>#</h4> </th>
        <th> <h4>User Full Name</h4> </th>
        <th> <h4>Transfer Number</h4> </th>
        <th> <h4>Vodafone Cash Number</h4> </th>
        <th> <h4>Paid Amount</h4> </th>
        <th> <h4>Status</h4> </th>
        <th> <h4></h4> </th>
      </tr>
    </thead>
    <tbody>
      <tr class="table-row">
        <td> <p>1</p> </td>
        <td> <p>Ismail Sherif</p> </td>
        <td> <p>01099454123</p> </td>
        <td> <p>01012345678</p> </td>
        <td> <p style="min-width: 100px;">34.67$</p> </td>
        <td> <p>Approved</p> </td>
        <td style="align-items: center;"> <button id="view-button" type="button" onclick="redirect('<?= 'payment_id' ?>')">View</button></td>
      </tr>
    </tbody>
  </table>
</div>

</form>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script>
  function redirect(id) {
    window.location.replace(`/payments/${id}`)
  }
</script>
<!-- Javascript End -->

</body>
</html>