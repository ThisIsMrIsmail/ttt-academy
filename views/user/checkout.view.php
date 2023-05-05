<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/user/css/checkout.css">
</head>

<body>

<main>
<form action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="platformTransferNumber" value="<?=$plat_trans_no?>">
<input type="hidden" name="total_amount" value="<?=$total_amount?>">

<div id="checkout">
  <div id="checkout-top">
    <h1 id="checkout-title">Checkout</h1>
    <a id="cancel-button" href="/"><p>Cancel</p></a>
  </div>
  <div id="checkout-container">
    <div id="checkout-left">
      <div id="checkout-info">
        <h2 id="checkout-note">Note</h2>
        <p id="checkout-note-description">
          Please make sure to the transfer the total amount to the Trible T Academy
          Vodafone Cash number without any typos that could make problem with giving
          you permission to the selected courses. We will contact you after you checkout within 24 hours.
        </p>
      </div>
      <div class="checkout-form-details">
        <div class="checkout-input">
          <label for="platformTransferNumber">Trible T Academy Vodafone Cash number</label>
          <input type="text" id="platformTransferNumber" value="<?=$plat_trans_no?>" disabled required>
          <button id="copy-button" type="button" onclick="copy()">copy</button>
        </div>
        <div class="checkout-input">
          <label for="transferNumber">Enter Your Vodafone Cash number</label>
          <input type="number" id="transferNumber" name="transferNumber" placeholder="ex: 01099414440" minlength="11" maxlength="16" required>
        </div>
        <div class="checkout-input">
          <label for="operationNumber">Enter Operation number</label>
          <input type="number" id="operationNumber" name="operationNumber" placeholder="ex: 643217989777" minlength="11" maxlength="16" required>
        </div>
        <div class="checkout-input">
          <label for="operationImage">Upload Operation Image</label>
          <input type="file" id="operationImage" name="operationImage" placeholder="" minlength="11" maxlength="16" accept="image/*" required>
        </div>
      </div>
    </div>
    <div id="checkout-right">
      <h2 id="checkout-summary">Summary</h2>
      <div id="checkout-total">
        <p id="checkout-total-title">Total:</p>
        <p id="checkout-total-amount"> <?=$total_amount?> $</p>
      </div>
      <div id="checkout-term-of-server">
        <p>By completing your purchase you agree to  these Terms of Service.</p>
      </div>
      <button id="checkout-button" name="pay_button" type="submit">Pay</button>
    </div>
  </div>
</div>

</form>  
</main>

<!-- Javascript Start -->
<?php require "./views/partials/scripts.php" ?>
<script src="/src/user/js/checkout.js"></script>
<!-- Javascript End -->

</body>
</html>