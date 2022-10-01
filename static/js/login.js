const form = document.forms['login-form'];
const errorMessage = document.getElementById("errorMessage");

if (form) {
  form.addEventListener('submit', validateLogin);
}

function validateLogin(event) 
{
  event.preventDefault();
  let pass = true;

  if ( form.username.value == "" ) {
    document.getElementById('username').classList.add("invalid")
    errorMessage.innerText = "Please fill both fields";
    pass = false;
  }
  if ( form.password.value == "" ) {
    document.getElementById('pass').classList.add("invalid")
    errorMessage.innerText = "Please fill both fields";
    pass = false;
  }

  if (pass) {
    form.submit();
  }
}