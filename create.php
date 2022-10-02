<? session_start(); ?>

<title>Create a Post</title>
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

  <script src="./static/js/createAPostScript.js" defer></script>
  <script src="./static/js/script-global.js" defer></script>

  <!-- FontAwesome Kit for Icons -->
  <script src="https://kit.fontawesome.com/5f78ca6619.js" crossorigin="anonymous"></script>
</head>
<body>
  <header class="header">
    <?php 
      $elevatedPerms = ['AUTHOR', 'ADMIN'];
      $basicPerms =  ['MEMBER', 'ADMIN'];
    ?>
    <a href="index.php">
      <img src="./static/images/logo.svg" alt="logo" class="logo">
    </a>
    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], $elevatedPerms)):?>
      <a href="create.php" class="link">Create a Post!</a>
    <?php endif; ?>
    <a href="about.php" class="link">About Us</a>

    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], $basicPerms)):?>
      <a href="archive.php" class="link">Archive</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
      <div class="link--session">
        <div>Welcome, <?php echo $_SESSION['username']; ?></div>
        <form method="POST" action="logout.php">
          <input class="link" name="btnSubmit" type="submit" value="Log Out"></input>
        </form>
      </div>
    <?php else:?>
      <a href="login.php" class="link link--session">Login</a>
    <?php endif; ?>
  </header>
  <section class="container">
    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], $elevatedPerms)):?>
      <div class="createAPost">
        <div class="divider">
          <span>
            <h1>Create a new post</h1>
          </span>
        </div>
        <form novalidate class="createForm" name="createAPostForm" method="POST" action="add-post.php">
          <input type="text" id="tileOfPostField" name="title" placeholder="Title of Post: (Max of 70 Characters)">
          <input type="text" id="tagsField" name="tagsField" placeholder="Enter the tags for the post: (Tags seperated by , )">
          <textarea id="contentField" name="contentField" placeholder="Enter the content of the post"></textarea>
          <input class="button" type="submit" value="Submit">
          <input class="button" type="reset">
          <h2 class="errorMessage" id="errorMessage"></h2>
        </form>
    <?php else: ?>
      <div>You don't appear to have permission to post. Please apply for authorship privileges</div>
    <?php endif; ?>
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