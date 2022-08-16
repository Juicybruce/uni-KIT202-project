const form = document.forms['register-form'];
const errorMessage = document.getElementById("errorMessage");

if (form) {
  form.addEventListener('submit', validateReg);
}

function validateReg(event) {
  event.preventDefault();
  let pass = true;
  let errorList = '';

  if ( form.username.value == "" ) {
    document.getElementById('username').classList.add("invalid")
    errorList += "Please enter a username <br>";
    pass = false;
  }

  // email
  if ( form.email.value == "" ) {
    document.getElementById('email').classList.add("invalid")
    errorList += "Please enter an Email <br>";
    pass = false;
  } else {
    if ( !ValidateEmail(form.email.value) ) {
      document.getElementById('email').classList.add("invalid")
      errorList += "Please enter an valid Email <br>";
      pass = false;
    }
  }

  // password
  if ( form.password.value == "" || form.confpass.value == "" ) {
    document.getElementById('pass').classList.add("invalid")
    document.getElementById('confpass').classList.add("invalid")
    errorList += "Please fill both password fields <br>";
    pass = false;
  } else {
    if ( !ValidatePass(form.password.value) ) {
      document.getElementById('pass').classList.add("invalid")
      document.getElementById('confpass').classList.add("invalid")
      errorList += "Your password must be 8 characters,<br> contain both upper and lower case letters,<br> a digit and a special symbol <br>";
      pass = false;
    } else {  
      if ( form.password.value != form.confpass.value ) { 
      document.getElementById('pass').classList.add("invalid")
      document.getElementById('confpass').classList.add("invalid")
      errorList += "The password fields do not match <br>";
      pass = false;
      }
    }
  } 

  // return
  if (pass) {
    form.submit();
  } else {
    errorMessage.innerHTML = errorList;
  }
}

function ValidateEmail(mail) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
    return (true)
  }
  return (false)
}

function ValidatePass(pass) {
  // Password Policy = minimum 8 letters, one upper and one lower case, at least one digit and one symbol
  if (/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(pass)) {
    return (true)
  }
  return (false)
}
