<?php
  session_start();
?>
<header class="header">
  <a href="index.php">
    <img src="assets/images/ares-logo.png" alt="company logo" height="88" class="header-logo" />
  </a>
  <nav>
    <ul class="primary-navigation">
    <?php
        if(isset($_SESSION["developer"])){
          ?> <li><a href="developer.php" class="sign-up-btn">Admin</a></li> <?php
        } 
      ?>
      <li><a href="index.php">Home</a></li>
      <li><a href="packages.php">Packages</a></li>
      <li><a href="aboutUs.php">About us</a></li>
      <?php
        if(!isset($_SESSION["email"])){
          ?> <li><a href="login.php" class="sign-up-btn">Log In</a></li> <?php
        } else {
          ?> <form action="logout.php" method="post">
            <button type='submit' class='sign-up-btn' name="token" value="<?php echo $_SESSION['token'];?>">Log Out</button>
        </form> <?php
        }
      ?>
      
    </ul>
  </nav>
  <button class="hamburger hamburger--slider" type="button">
    <span class="hamburger-box">
      <span class="hamburger-inner"></span>
    </span>
  </button>
</header>