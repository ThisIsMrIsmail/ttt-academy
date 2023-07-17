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
        <th> <h4>User Transfer Number</h4> </th>
        <th> <h4>Academy Transfer Number</h4> </th>
        <th> <h4>Paid Amount</h4> </th>
        <th> <h4>Status</h4> </th>
        <th> <h4></h4> </th>
      </tr>
    </thead>
    <tbody>
      
      <?php if ( ! $payments ) { ?>
        <tr> <td colspan="6"> <h2>There are No Payments</h2> </td> </tr>
      <?php } ?>

      <?php foreach ($payments as $key => $payment) { ?>
      <form action="" method="post">
        <input type="hidden" name="payment_id" value="<?=$payment['payment_id']?>">
        <tr class="table-row">  
          <td> <p> <?=$key+1?> </p> </td>
          <td> <p> <?php echo $payment["user_id"]=="" ? "None" : $payment["user_full_name"] ?> </p> </td>
          <td> <p> <?=$payment["payment_transfer_number"]?> </p> </td>
          <td> <p> <?=$payment["payment_platform_transfer_number"]?> </p> </td>
          <td> <p style="min-width: 100px;"> <?=$payment["payment_total_paid_amount"]?> $</p> </td>

        <?php if ( $payment["payment_status"] == 0 ): ?>
          <td> <p class="status rejected">Rejected <img src="/src/partials/svg/check-false.svg" alt=""></p> </td>
        <?php elseif ( $payment["payment_status"] == 1 ): ?>
          <td> <p class="status approved">Approved <img src="/src/partials/svg/check-true.svg" alt=""></p> </td>
        <?php elseif ( $payment["payment_status"] == 2 ): ?>
          <td> <p class="status pending">Pending <img src="/src/partials/svg/clock.svg" alt=""></p> </td>
        <?php endif; ?>
        
          <td style="align-items: center;">
            <button id="show-dialog" onclick="showDialog(<?=$payment['payment_id']?>)" type="button">View</button>
            
            <dialog id="<?=$payment['payment_id']?>">
              <button id="close-dialog" onclick="closeDialog(<?=$payment['payment_id']?>)" type="button">×</button>
              <!-- button for closing dialog -->
              <div id="dialog-container">
                <div id="payment-user-info">
                  <div id="person">
                    <div id="person-img">
                      <?php
                        $id = $payment['user_id'];
                        if ( $id != "" AND file_exists("uploads/users/$id") ) {
                          $user_img = glob("uploads/users/$id/image_$id.*")[0];
                        } else {
                          $user_img = "src/partials/user-img/user-img-0.jpg";
                        }
                      ?>
                      <img src="/<?=$user_img?>" alt="">
                    </div>
                    <div id="person-info">
                      <p> <strong>Full Name:</strong>
                        <?php echo $payment["user_id"]=="" ? "None" : $payment["user_full_name"] ?></p>

                      <p> <strong>Contact Number:</strong>
                        <?php echo $payment["user_contact_number"]=="" ? "None" : $payment["user_contact_number"] ?></p>

                      <p> <strong>Email:</strong>
                        <?php echo $payment["user_email"]=="" ? "None" : $payment["user_email"] ?></p>

                      <p> <strong>Payment Date:</strong> <?=$payment["payment_action_date"]?> </p>
                      <p> <strong>User Trans. No: </strong> <?=$payment["payment_transfer_number"]?> </p>
                      <p> <strong>TTT Trans. No: </strong> <?=$payment["payment_platform_transfer_number"]?> </p>
                      <p> <strong>Paid Amount: </strong> <?=$payment["payment_total_paid_amount"]?>$ </p>
                    </div>
                  </div>

                <div id="dialog-submission">
                <?php if ($payment["payment_status"] != 2) { ?>
                  <p style="margin-bottom: 10px">
                    Payment already <strong>submitted</strong> <br>
                    You can't change payment status of this payment.
                  </p>
                <?php } ?>
                <?php if ($payment["payment_status"] == 2) { ?>
                  <button id="submit-dialog-approve" name="approve" type="submit">Approve</button>
                  <button id="submit-dialog-reject" name="reject" type="submit">Reject</button>
                <?php } ?>
                </div>

                </div>
              
                <div id="operation-image-container">
                  <?php $id = $payment["payment_id"];
                  if ( file_exists("uploads/payments/$id") )
                    $img = glob("uploads/payments/$id/*")[0]; ?>
                  <a href="/<?=$img?>" target="_blank">
                    <img id="operation-image" src="/<?=$img?>" alt="">
                  </a>
                </div>
              </div>
            </dialog>

          </td>
        </tr>
      </form>
      <?php } ?>

    </tbody>
  </table>

</div>

</form>
</main>

<!-- Javascript Start -->
<script>
  function showDialog(dialogId) {
    let dialog = document.querySelector(`dialog[id='${dialogId}']`)
    if (dialog) {
      dialog.showModal()
    }
  }
  function closeDialog(dialogId) {
    let dialog = document.querySelector(`dialog[id='${dialogId}']`)
    if (dialog) {
      dialog.close()
    }
  }
</script>

<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>