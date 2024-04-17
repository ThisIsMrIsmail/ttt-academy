
let modal = document.querySelector("dialog")
let showModal = document.getElementById("show-dialog")
let closeModal  = document.getElementById("close-dialog")

if (modal) {
  showModal.addEventListener("click", () => {
    modal.showModal()
  })
  closeModal.addEventListener("click", () => {
    modal.close()
  })
}
