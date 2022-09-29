<title>Archive</title>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta name="author" content="Alex Drew, Giang, Katherine Peschar">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google fonts  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./static/css/style.css">

  <script src="./static/js/script-global.js" defer></script>
  <script src="./static/js/archive.js" defer></script>

  <!-- FontAwesome Kit for Icons -->
  <script src="https://kit.fontawesome.com/5f78ca6619.js" crossorigin="anonymous"></script>
</head>
<body>
  <header class="header">
    <a href="index.php">
      <img src="./static/images/logo.svg" alt="logo" class="logo">
    </a>
    <a href="login.html" class="link">Login</a>
    <a href="create.html" class="link">Create a Post!</a>
    <a href="about.html" class="link">About Us</a>
    <a href="archive.php" class="link">Archive</a>
  </header>
  <?php 
    require "./dbconn.php";
    $sql = "SELECT postTitle, postDATE, postContent 
            FROM POST 
            ORDER BY postDate DESC
            LIMIT 4,18446744073709551615;"; //limit with two params will offset by the first and retrieve til the second 
    $response = $conn->query($sql);

    if ($response && $response->num_rows > 0): ?>
      <section class="container">
        <?php while ($row = $response->fetch_assoc()): ?>
          <div class="post">
            <div class="post-header">
              <h4 class="post-title"><?php echo $row['postTitle']; ?></h4>
              <p class="post-date">Posted on: <?php echo $row['postDATE']; ?></p>
            </div>
            <p class="post-content"><?php echo $row['postContent']; ?></p>
            <div class="post-tags"> Tagged:
              <a href="#">lorem</a>
              <a href="#">ipsum</a>
              <a href="#">dolor</a>
              <a href="#">sit</a>
              <a href="#">consectetur</a>
            </div>
          </div>
        <?php endwhile; ?>
      </section>

    <?php endif; ?>
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