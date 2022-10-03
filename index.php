<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<title>Home</title>
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
      <div class="session-box link--session ">
        <div>Welcome, <?php echo $_SESSION['username']; ?></div>
        <form method="POST" action="logout.php">
          <button class="link" name="btnSubmit" type="submit">Log Out</button>        </form>
      </div>
    <?php else:?>
      <a href="login.php" class="link session-box link--session ">Login</a>
    <?php endif; ?>
  </header>

  <?php 
      require "./dbconn.php";
      $selectPostSQL = "SELECT * 
              FROM POST 
              ORDER BY postDate DESC, postID DESC
              LIMIT 4;";
      
      $selectHasTagSQL = "SELECT * FROM HASTAGS;";

      $responsePost = $conn->query($selectPostSQL);

      if ($responsePost && $responsePost->num_rows > 0){ ?>
        <section class="container">
          <?php while ($rowPost = $responsePost->fetch_assoc()){?>
            <?php
            $accountID = $rowPost['accountID'];
            $selectAccountSQL = "SELECT * FROM ACCOUNT WHERE accountID = '$accountID';";
            
            $responseAccount = $conn->query($selectAccountSQL);

            $rowAccount = $responseAccount->fetch_assoc();
            ?>
            <div class="post">
              <div class="post-header">
                <h4 class="post-title"><?php echo $rowPost['postTitle']; ?></h4>
                <p class="post-date">Posted on: <?php echo $rowPost['postDATE']; ?> By <?php echo $rowAccount['accountName']; ?></p>
              </div>
              <p class="post-content"><?php echo $rowPost['postContent']; ?></p>
              <?php 
              $tagArray = array();
              $responseHasTags = $conn->query($selectHasTagSQL);
              $selectTagSQL = "SELECT * FROM TAG";
              if($responseHasTags && $responseHasTags->num_rows > 0) {
                 while($rowHasTags = $responseHasTags->fetch_assoc())
                 {
                    if($rowPost['postID'] === $rowHasTags['postID'])
                    {
                      $tagArray[count($tagArray)] = $rowHasTags['tagID'];
                    }
                 } 
                echo '<div class="post-tags"> Tagged:';
                $responseTag = $conn->query($selectTagSQL);
                if($responseTag && $responseTag->num_rows > 0)
                {
                  while($rowTags = $responseTag->fetch_assoc())
                  {
                    foreach($tagArray as $tag) {
                      if($rowTags['tagID'] === $tag)
                      {
                        echo '<a href="results.php?tag='.$rowTags['tagID'].'">'.$rowTags['tagName'].'</a>';
                      }
                    }
                  }
                }
                echo '</div>';
              } 
              $selectRatesSQL = "SELECT * FROM RATES;";

              $responseRates = $conn->query($selectRatesSQL);
              
              $rating = 0;
              if($responseRates && $responseRates->num_rows > 0) {
                while($rowRates = $responseRates->fetch_assoc()) {
                    if($rowRates['postID'] === $rowPost['postID'])
                    {
                      $rating++;  
                    }
                }
                ?>
                <div class="ratings">
                  <a href=<?php echo '"rate.php?id='.$rowPost['postID'].'&previous='.$_SERVER['REQUEST_URI'].'"'?>> <?php echo 'Ratings: '.$rating?> </a>
                </div>
                <?php
              }
              ?>
            </div>
          <?php } ?>     
        </section>
      <?php } ?> 
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
