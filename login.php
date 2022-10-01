<?php
require "dbconn.php";
 
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    if(authenticate($username, $password) == true) {
      header("location: 'index.php'");
    }
    else {
        echo "<p>Invalid username or password.</br>Please try again.</p>";
    }
}

function authenticate($user, $pass)
{
    global $conn;

    $sql = "SELECT accountPassword FROM ACCOUNT WHERE accountName='$user'";
    $result = $conn->query($sql);
    
    if (password_verify($pass, $result->fetch_assoc())) {
      return true;
    }
    else {
      return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<title>Login</title>
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

  <script src="./static/js/login.js" defer></script>
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
        <h1>Login into your account</h1>
        <p>Login using your social accounts:</p>
        <div class="login-socials">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-google-plus"></i>
          <i class="fab fa-linkedin"></i>
        </div>
        <div class="divider"><span>Or login here</span></div>
        <form class="login-form" name="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <input type="text" id="username" name="username" placeholder="Email or Account Name">
          <input type="password" id="pass" name="password" minlength="8" required placeholder="Password">
          <input class="button" name="submit" type="submit" value="Sign In"></input>
        </form>
        <h2 class="errorMessage" id="errorMessage"></h2>
        <div class="divider"><span>Don't have an account yet?</span></div>
        <a href="./register.php" class="register-button">Sign up here!</a>
      </div>
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
</html>