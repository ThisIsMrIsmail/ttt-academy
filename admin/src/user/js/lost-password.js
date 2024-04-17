
let dialogLostPassword = document.getElementById("lost-password-contianer")
let showDialog = document.getElementById("show-dialog")
let closeLostPassword = document.querySelector(".close-dialog-lost-password")
let emailInput = document.getElementById("lost-password-email")

emailInput.focus(); 

showDialog.addEventListener("click", () => {
  dialogLostPassword.showModal()
})

closeLostPassword.addEventListener("click", () => {
  dialogLostPassword.close()
})
