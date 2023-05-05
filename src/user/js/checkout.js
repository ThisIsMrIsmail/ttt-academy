
let user_transfer_number_input = document.querySelector("#transferNumber")
user_transfer_number_input.focus()

function copy() {
  var number = document.getElementById("platformTransferNumber");
  number.select();
  number.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(number.value);
  createAlertMessage("Number Copied Successfuly!", "success")
}
