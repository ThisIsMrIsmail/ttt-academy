<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Platform Transer Number | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/admin/css/transfer-number.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/admin-header.php" ?>


<!-- Main Start -->
<main>
<form action="" method="post" id="form">
  
  <div id="transfer-number">

    <div id="transfer-number-container">
      <div id="transfer-number-content">
        <h3>Platform Transer Number:
          <?php
            if ( $transfer_number )
              echo $transfer_number[0]["plat_trans_no"];
            else
              echo "NONE";
          ?>
        </h3>
        <h4>Update:</h4>
        <input type="text" name="transfer_number" class="number" minlength="11"
          maxlength="16" placeholder="Enter Platform Transfer Number" required>
        <button name="save" type="submit">save</button>
      </div>
    </div>

  </div>

</form>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<script src="/src/admin/js/transfer-number.js"></script>


</body>
</html>