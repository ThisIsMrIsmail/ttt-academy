<!-- Start of Styling -->
<link rel="stylesheet" href="/src/user/css/verify.css">
<!-- End of Styling -->


<dialog id="verify">
  
  <button id="close-dialog" class="close-dialog-verify" type="button">×</button>
  <h2>Verify Your Account</h2>
  <p>Verification code will be send to your email address.</p>
  
  <!-- START verification code form -->
  <form action="" method="POST">
    <div class="dialog-input">
      <input type="text" name="vf_code" id="vf-code" class="number"
        placeholder="Enter verification code" minlength="6" maxlength="6" required>
      <button id="submit-dialog-verify" name="verify" type="submit">Verify</button>
    </div>
  </form>
  <!-- END verification code form -->

  
  <!-- START Resend code form -->
  <form action="" method="POST" id="resend-form">
    <!-- button textContent is set from the sessionStorage of JavaScript -->
    <button id="submit-dialog-resend" name="resend" type="submit"></button>
  </form>
  <!-- END Resend code form -->

</dialog>


<!-- Start JavaScript -->
<script src="/src/user/js/verify.js"></script>
<!-- End JavaScript -->