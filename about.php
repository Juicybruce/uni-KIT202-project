<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<title>About</title>
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
      $basicPerms =  ['MEMBER', 'AUTHOR', 'ADMIN'];
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

  <section class="container">
    <h1>About us</h1>
    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Changes made for Assignment 2</h4>
      </div>
      <p class="post-content">
        In order to dynamically populate the home page with the latest posts, we utilized the PHP language and a MySQL database to retrieve stored posts. We first establish a remote connection with the database using appropriate credentials. This data contains a table of “Posts”, at first filled manually, and then filled via the ‘Create Post’ section of the website.
        <br><br>
        Once this connection is verified, we can then use the connection to submit queries to retrieve post data. The main and most basic is retrieving all the columns from the posts themselves, ordered by date and limited to the latest 4 (as per the spec). Other queries are made to other tables to retrieve relational data relating to posts, ie, the tags associated etc. 
        <br><br>
        The objects retrieved by these queries are then iterated over to dynamically build the HTML that will be displayed in the browser, having its content filled by what is stored in the database.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">HTTP Method</h4>
      </div>
      <p class="post-content">
        We have chosen to use the POST method for most form submissions across the website.
        <br><br>
        The POST method has various advantages over GET, the other main alternative. First of all, the data sent is not encoded directly into the URL, but are rather encoded into the body of the request. This allows for larger amounts of data to be sent, as URLs are naturally restricted in length. This also causes the content of the request to be less ‘visible’ to the user (in the URL), but also prevents browser caching or bookmarking of form submissions.
        <br><br>
        While on the form that submits post data to the database, the POST method is useful given there are no restrictions on data sent, it is more essential on form submission for user logins for security reasons. As we are sending data over SSL, the data is obfuscated using either method. However, GET requests have the URL query stored both in browser history, as well as logged by web servers by default, making it problematic for use with sensitive values.
        <br><br>
        The cases where we did use GET was where the data was not sensitve which was the case in ratings system and the system for returing tags.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">User Roles</h4>
      </div>
      <p class="post-content">
        User roles are handled with a combination of authentication and session data. Firstly, a user may register an account in the database, which stores the details they enter, as well as a hashed version of their password. Upon attempting to login, these details are retrieved and compared to the ones provided. If they match, session data matching the users ID, username and role are stored.
        <br><br>
        It is this session data that is used to give the other functionality. If it is set, a user is logged in. A combination of the username and the ID are utilized to identify the user where necessary, ie, in the welcome message or created posts (username) or keeping track of post ratings (ID). As we are utilizing the superglobal session variables to do this, persistence between pages is trivial, the session and its variables are stored not on the pages, but in the server.
        <br><br>
        The roles are also identified as being part of a ‘basically privileged’ group, or an ‘elevated privileged’ group. The former is a basic member and can view posts, the latter is an author and may create posts. An admin possesses the priviledges of both. Both the header buttons and the pages themselves perform a check before displaying, to ensure the role the user is present in the relevant permissions array. If not, they are not displayed or in the case of pages, a message to that effect is shown in place of any content.
        <br><br>
        When a user logs out, their session and its data is destroyed and to log in again they must undergo authentication again.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Sanitisation and Security</h4>
      </div>
      <p class="post-content">
        There are two main methods used for sanitizing user-sourced input within the website (ie, registration, login and post submission forms).
        <br><br>
        The first of these is the htmlspecialchars() PHP method. This ensures that certain characters that have special significance to a HTML processor such as & < or > are replaced with html entities that refer to the same symbols, but are not processed as such. Those three symbols would become: &amp, &lt and &gt. This is primarily to prevent XSS attacks.
        <br><br>
        Another method used in some places is real_escape_string(). This has a similar function but acts to escape any user-input that would have special significance when read into the database as a SQL query. This includes quotes, but also \, \r and \n. This is to prevent SQL-injection attacks, preventing any user inputted data from being processed as a malicious query.
        <br><br>
        There is some overlap in these two functions (namely ‘ and “), but between them they cover most possible incidents of malformed or malicious code injection.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Extensions</h4>
      </div>
      <p class="post-content">
      For the additional features section of the assignment we implemented two new features the first of which is allowing users to rate posts and second of which was letting users search for all posts under a certain tag. 
      <br><br>
      The first of which is implemented by adding a new table to our SQL database RATES which is an all to all type for ACCOUNT and POST which contains both of their IDs. Then when retrieving each post we first grab all RATES and search for all entries with the same post ID as the post being grabbed and for each one increment a variable for each post and then display on the post. Then if a user clicks on the ratings it checks if the user already has a rating for that post and if not it adds a new entry into RATES.
      <br><br>
      The second of which was implemented by having each tag entry on a post be a link that leads to a new page and then shows all posts with that tag. This was done via sending the tag’s ID by GET and then checking all of the HASTAGS (Which is made up of a tag’s id and a post’s id) entries with that tag’s ID and adding all of the posts with the corresponding ID into an array. Then when displaying posts it only displays if that post’s ID is in the array.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Theme of the Blog</h4>
      </div>
      <p class="post-content">
        The theme of the website that we chose was a Lorem Ipsum fansite which was chosen as a theme due to our appiraction for Lorem Ipsum as it is a useful tool in web design to make sure text and content is looking how you want it to. Because of this we decided to use Lorem Ipsum for all of our text content because of this. <br>
        <br> We chose the visuals of our website by using red for the footer and header background because it contrasts against the grey of the background while still being easily readable. We also used blue and soft yellow for the other colours internally as they contrast against the background while still being easily readable. We chose readability as the main thing as Lorem Ipsum has had a history of being used quite frequently in typography and felt that was a way to connect it to the aesthetic of the website.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Password Policy</h4>
      </div>
      <p class="post-content">
        The password policy the group has chosen consists of the follow: <br>
          - A minimum of 8 characters <br>
          - at least 1 capital letter <br>
          - at least 1 lower case letter <br>
          - one digit 0-9 <br>
          - one special character <br>

          Each of these are enforced to make sure passwords that are selected by users are more resilient against brute-force hash breaking techniques and are less likely to be commonly reused passwords that are easily guessed (123456, batman, password). 
          In this way even if passwords selected are obvious (from a social deduction standpoint), or reused, enforcing special characters, digits and mixed case hopefully adds enough variation to resist credential stuffing. <br>

         <br>The minimum of 8 characters is what is currently recommended for the lower limit by the <a href="https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html">OWASP foundation</a> in their guidance on Authentication in general.
          While we would enforce an upper limit of 64 characters to allow compliance with certain hashing algorithms and to prevent Denial of Service attacks via massive password string being sent to the backend server, that is piece of functionality that will be added when we have a backend service that needs such protection. <br>
          
          <br> While we do enforce the use of special characters (unrestricted, unicode characters checked for and regex characters being escaped in the check), there is an argument to be made that the preferred password is one of 'phrases' rather than complicated pass 'words'
          This is certainly valid, as passphrases (with spaces) give a far higher resilence to certain kinds of attacks (<a href="https://imgs.xkcd.com/comics/password_strength.png">so long as one does not use the words 'battery' or 'horse'</a>), while being far easier to remember . However, we have opted for the more traditional approach.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">New registration</h4>
      </div>
      <p class="post-content">
        For the new user registration we decided to make it onto its on separate page rather than have it displayed on top of an already existing page. We decided to do it this way because of two main reasons the first of which is due to making it easier to create on our end. This is due to having the page separated makes it easier to only address to that page only rather than having to compact both login and registration into one page. The other main reason is that from a user perspective having it on one page only means that it becomes harder to accidentally lose what you have entered so far due to the more focused options.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Embellishments</h4>
      </div>
      <p class="post-content">
        For additional features the main one that has been added is the footer to the page with it being added through the use of <footer>. This was done to create something that would mirror the header in order to create a bottom of the page that feels like a more natural end point of the page. The other additional feature is adding social buttons through the use of a icon kit to link to various social media websites. This also was put in the footer of the page to help the footer not be just empty space.
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Sources</h4>
      </div>
      <p class="post-content">
        We are utilising the Mulish san serif font, designed by Vernon Adams, Cyreal and Jacques Le Bailly. Available <a href="https://fonts.google.com/specimen/Mulish?query=mulish">Here</a><br>
        <br>We are also utilising <a href="https://fontawesome.com/">FontAwesome 5</a> for icons (as a free version webkit), specifically the "angle-up", "angle-down" and four common social media icons. <br>
        <br> The logo icon is a public domain SVG <a href="https://freesvg.org/graphite-mountain-logo">available here</a> <br>
        <br>The content for the blogs are information for the Lorem Ipsum placeholder texts, cited directly from the <a href="https://loremipsum.io/">Lorem Ipsum website</a><br>
      </p>
    </div>

    <div class="post">
      <div class="post-header">
        <h4 class="post-title">Group Members</h4>
      </div>
      <p class="post-content">
        Alex Drew - 165 387<br>
        Katherine Peschar - 558900 <br> 
        Nguyen Ngan Giang Lai- 605736 <br>
      </p>
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
