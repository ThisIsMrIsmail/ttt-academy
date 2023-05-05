
let selected_image = document.querySelector("#profile-img-upload input")
let preview = document.getElementById("image-preview")
let paragraph = document.querySelector("#image-preview p")

// allowed file types
const fileTypes = [
  "image/jpg",
  "image/png",
  "image/jpeg"
];
// function to validate file types
function validFileType(file) {
  return fileTypes.includes(file.type);
}

selected_image.addEventListener("change", () => {

  // getting selected file
  file = selected_image.files[0]
  // removing all of the child items inside preview div
  while(preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }
  // checking if file selected
  if ( ! file ) { // file not selected
    let paragraph = document.createElement('p');
    paragraph.textContent = 'No files currently selected for upload';
    preview.appendChild(paragraph);
    return
  }

  // previewing image
  if ( validFileType(file) ) {
    let image = document.createElement("img")
    image.src = URL.createObjectURL(file)
    preview.appendChild(image)
  } else {
    let paragraph = document.createElement("p")
    paragraph.textContent = "File uploaded is not an image."
    preview.appendChild(paragraph)
  }
})
