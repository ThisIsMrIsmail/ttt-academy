
let fullname = document.querySelector("input[name='fullname']")
let username = document.querySelector("input[name='username']")

fullname.focus()

username.addEventListener("focus", () => {
  createAlertMessage(
    "Be aware that \"Username\" can't be changed after your account is created!",
    "warning"
  )
}, {once : true})

// forcing input username to lowercase to avoid problem
// with accounts same username but with different cases
username.addEventListener("input", () => {
  username.value = username.value.toLowerCase();
})
