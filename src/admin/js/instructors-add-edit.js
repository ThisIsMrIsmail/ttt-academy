
let instructor_name = document.getElementById("instructor-name");
instructor_name.focus();


// Displaying message when submitting the form
let form = document.getElementById("instructor-form")
form.addEventListener("submit", () => {
  createAlertMessage("Instructor Data Saved successfully.", "success")
})
