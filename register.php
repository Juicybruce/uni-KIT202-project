<?php
require "dbconn.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $username = htmlspecialchars($_POST["username"]);
  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);
  $confirmed_password = htmlspecialchars($_POST["confirmPass"]);
  $hash_pass = crypt("$password");
  if (check_username($username) = true) {
    echo "<p>Username already existed, please enter a different username.</p>";
  }  
  elseif (check_email($email) = true) {
    echo "<p>Email already registered.</p>";
  }
  else {
    $insertPostSQL = "INSERT INTO ACCOUNT
        (accountName, accountPassword, accountRole, accountEmail) 
        VALUES 
        ('$user', '$hash_pass', 'MEMBER', '$email');";
    header("location: 'login.php'");
  }
}

function check_username($user)
{
    global $conn;

    $sql = "SELECT accountName FROM ACCOUNT WHERE accountName='$user'";
    $result = $conn->query($sql);

    if ($result) {
      if (mysqli_num_rows($result) > 0) {
      return true;
    }
    else {
      return false;
    }
  }
}

function check_email($email)
{
    global $conn;

    $sql = "SELECT accountEmail FROM ACCOUNT WHERE accountEmail='$email'";
    $result = $conn->query($sql);

    if ($result) {
      if (mysqli_num_rows($result) > 0) {
      return true;
    }
    else {
      return false;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<title>Register</title>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta name="author" content="Alex Drew, Nguyen Ngan Giang Lai, Katherine Peschar">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google fonts  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./static/css/style.css">

  <script src="./static/js/reg-script.js" defer></script>
  <script src="./static/js/script-global.js" defer></script>

  <!-- FontAwesome Kit for Icons -->
  <script src="https://kit.fontawesome.com/5f78ca6619.js" crossorigin="anonymous"></script>
</head>
<body>
  <header class="header">
    <a href="index.php">
      <img src="./static/images/logo.svg" alt="logo" class="logo">
    </a>
    <a href="login.php" class="link">Login</a>
    <a href="create.html" class="link">Create a Post!</a>
    <a href="about.html" class="link">About Us</a>
    <a href="archive.php" class="link">Archive</a>
  </header>
  <section class="container">
    <div class="login">
      <div class="login-header">
        <img src="./static/images/logo.svg" alt="logo" class="logo">
        <div class="logo-name">Graphite Collective</div>
      </div>
      <div class="login-content">
        <div class="divider"><span><h1>Register a new account!</h1></span></div>
        <form class="login-form" method="POST" name="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <input type="text" id="username" name="username" placeholder="Account Name">
          <input type="text" id="email" name="email" placeholder="Email Address">
          <input type="password" id="pass" name="password" placeholder="Password">
          <input type="password" id="confpass" name="confirmPass"  placeholder="Confrim Password">
          <div class="errorMessage" id="errorMessage"></div>
          <input class="button" type="submit" value="Register!"></input>
          <input class="button" type="reset" value="Reset"></input>
        </form>
    </div>
  </section>
  <footer class="footer">
    <div class="social-icons">
      <i class="fab fa-twitter"></i>
      <i class="fab fa-facebook"></i>
      <i class="fab fa-instagram"></i>
      <i class="fab fa-github-alt"></i>
    </div>
    <p class="acknowledgment">We acknowledge and pay respect to the traditional custodians and elders of this nation, past, present and future, and the continuation of cultural, spiritual and educational practices of Aboriginal and Torres Strait Islander peoples.</p>
  </footer>
</body>