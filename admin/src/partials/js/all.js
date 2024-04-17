

// Alert Message Function
function createAlertMessage(text, alertType) {
  // removing the old alert div if exists
  let oldAlertMessage = document.querySelector(`.${alertType}-alert-message`);
  
  if (oldAlertMessage) {
    let oldAlertText = oldAlertMessage.querySelector("p").textContent
    if ( text == oldAlertText )
      oldAlertMessage.remove()
  }

  const main = document.querySelector("main");

  // checking if alert messages container exists
  let alertMessagesContainer = document.querySelector(".alert-messages-container")
  if ( ! alertMessagesContainer ) {
    alertMessagesContainer = document.createElement("div");
    alertMessagesContainer.classList.add("alert-messages-container")
    document.body.insertBefore(alertMessagesContainer, main);
  }

  // creating alert div
  const div = document.createElement("div");
  div.classList.add(alertType + "-alert-message")
  // creating message content
  const message = document.createElement("p")
  message.textContent = text;
  // creating close button
  const closeButton = document.createElement("button")
  // getting color of the button
  const color = alertType == "success" || "warning" ? "#454545" : "#FFFFFF";
  closeButton.innerHTML = `
    <svg xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' fill='${color}' width='24' height='24'>
      <path d="M21 5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5zm-4.793 9.793-1.414 1.414L12 13.414l-2.793 2.793-1.414-1.414L10.586 12 7.793 9.207l1.414-1.414L12 10.586l2.793-2.793 1.414 1.414L13.414 12l2.793 2.793z"></path>
    </svg>
  `;
  // activating close button
  closeButton.addEventListener("click", () => {
    div.remove();
  })
  // appending elements
  div.append(message)
  div.append(closeButton)
  alertMessagesContainer.prepend(div);

  setTimeout(() => { div.remove() }, 10000);
}


// Redirect Function
function redirect(route) {
  setTimeout(() => {
    window.location.href = route
  }, 1500);
}


// handling input class="number" to only allow numbers 
let number_input = document.querySelector("input[class='number']");
let input_form = document.querySelector("form");

if (number_input) {
  // input eventlistener
  number_input.addEventListener("input", () => {
    var value = number_input.value;
    if (value != '') {
      if ( isNaN(value) ) {
        number_input.value = "";
        input_form.reset();
      }
    }
  })
}