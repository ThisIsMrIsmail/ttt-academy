let dialogVerifiyDialog = document.getElementById("verify")
let closeVerifiyDialog = document.querySelector(".close-dialog-verify")

closeVerifiyDialog.addEventListener("click", () => {
  dialogVerifiyDialog.close()
})

let resendButton = document.getElementById("submit-dialog-resend")
let resendForm = document.getElementById("resend-form")
let vfCodeInput = document.getElementById("vf-code")
vfCodeInput.focus()

resendButton.textContent = sessionStorage.getItem("resendButtonText") || "Send Code"

// changing button displayed name
resendButton.addEventListener("click", () => {
  sessionStorage.setItem("resendButtonText", "Resend Code");
}, {once: true})

// handling input class="number" to only allow numbers 
let numInput = document.getElementById("vf-code");
let inForm = document.querySelector("form");

if (numInput) {
  // input eventlistener
  numInput.addEventListener("input", () => {
    var value = numInput.value;
    if (value != '') {
      if ( isNaN(value) ) {
        numInput.value = "";
        inForm.reset();
      }
    }
  })
}