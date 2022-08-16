const form = document.forms['register-form'];
const errorMessage = document.getElementById("errorMessage");

if (form) {
  form.addEventListener('submit', validateReg);
}

function validateReg(event) {
  event.preventDefault();
  let pass = true;

  if ( form.username.value == "" ) {
    document.getElementById('username').classList.add("invalid")
    pass = false;
  }

  // email
  if ( form.email.value == "" ) {
    document.getElementById('email').classList.add("invalid")
    pass = false;
  } else {
    if ( !ValidateEmail(form.email.value) ) {
      document.getElementById('email').classList.add("invalid")
      pass = false;
    }
  }

  // password
  if ( form.password.value == "" || form.confpass.value == "" ) {
    document.getElementById('pass').classList.add("invalid")
    document.getElementById('confpass').classList.add("invalid")
    pass = false;
  } else {
    if ( form.password.value === form.confpass.value ) {
      document.getElementById('pass').classList.add("invalid")
      document.getElementById('confpass').classList.add("invalid")
      pass = false;
    }
  }
  pass === true ?  true :  false;
}

function ValidateEmail(mail) 
{
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
    return (true)
  }
  return (false)
}