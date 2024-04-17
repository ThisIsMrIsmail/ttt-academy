
let modal = document.querySelector("dialog")
let show = document.getElementById("show-dailog")
let close  = document.getElementById("close-dailog")

show.addEventListener("click", () => {
  modal.showModal()
})

close.addEventListener("click", () => {
  modal.close()
})