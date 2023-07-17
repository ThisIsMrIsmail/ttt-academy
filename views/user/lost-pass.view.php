<!-- Start of Styling -->
<link rel="stylesheet" href="/src/user/css/lost-password.css">
<!-- End of Styling -->


<dialog id="lost-password-contianer">
  <button id="close-dialog" class="close-dialog-lost-password" type="button">×</button>
  <h2>Lost the password, no problem</h2>
  <p>
    We're sorry to hear that you've lost your password. We will generate
    a new one for you. Please keep your new password so that you can access
    your account, or you can edit it from your account security settings.
  </p>
  <form action="" method="POST">
    <div class="dialog-input">
      <input name="email" id="lost-password-email" type="email" placeholder="Enter your email account" required>
      <button id="submit-dialog-send-password" name="send_password" type="submit">Send</button>
    </div>
  </form>
</dialog>


<!-- Start JavaScript -->
<script src="/src/user/js/lost-password.js"></script>
<!-- End JavaScript -->