<?php
session_start();

require_once "lib/database.php";
require_once "lib/functions.php";

use CYBORG\Lib\Database;

$db = new Database();

$menuItems = [
  'Home' => 'index.php',
  'Browse' => 'browse.php',
  'Streams' => 'streams.php',
];

$currentUser = isUserLoggedIn() ? $_SESSION['loggedInUser'] : [];

function displayProfileSection($currentUser) {
  if (isUserLoggedIn()) {
      echo '
          <a href="profile.php">Profile <img src="' . getProfilePicture($currentUser) . '" alt="Profile Picture"></a></li>
      ';
  } else {
      echo '
          <a href="login.php" style="padding:10px 15px 10px 15px;">Log In</a></li>
      ';
  }
}

?>

<header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <a href="index.php" class="logo">
              <img src="assets/images/logo.png" alt="">
            </a>
            <div class="search-input">
              <form id="search" action="#">
                <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword"
                  onkeypress="handle" />
                <i class="fa fa-search"></i>
              </form>
            </div>
            <ul class="nav" id="navigation">
              <?php
                foreach ($menuItems as $label => $link) {
                  echo '<li><a href="' . $link . '">' . $label . '</a></li>';
                }
              ?>
              <li><?php displayProfileSection($currentUser) ?></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
          </nav>
        </div>
      </div>
    </div>
</header>