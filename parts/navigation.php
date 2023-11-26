<?php

require_once "lib/database.php";

use CYBORG\Lib\Database;

$db = new Database();

$connectedUser = $db->getProfileData(1);

function getProfilePicture($connectedUser) {
  $profilePicture = "assets/images/profiles/";
  if (!empty($connectedUser)) {
    $profilePicture .= $connectedUser['profile_picture'];
  } else {
    $profilePicture .= "default.jpg";
  }
  return $profilePicture;
}

function formatDownloads($count)
{
  $suffix = '';
  if ($count >= 1000000) {
    $count = $count / 1000000;
    $suffix = 'M';
  } elseif ($count >= 1000) {
    $count = $count / 1000;
    $suffix = 'K';
  }

  $formattedCount = number_format($count, 1);

  return $formattedCount . $suffix;
}

// tieto 2 funkcie sú len preto lebo sa mi nechcelo pre každú hru nahrávať obrázky
// tak sa ako default použije game.jpg

function getGameHeader(string $gameHeader) {
  $gameImagePath = 'assets/images/games/' . $gameHeader;
  $defaultImagePath = 'assets/images/games/game.jpg';

  return file_exists($gameImagePath) ? $gameImagePath : $defaultImagePath;
}

function getGameImage(string $gameUniqueName) {
  $gameFolderPath = 'assets/images/games/' . $gameUniqueName;
  $images = scandir($gameFolderPath);
  $images = array_slice($images, 2);

  if (empty($images)) {
      return [
          'assets/images/games/game.jpg',
          'assets/images/games/game.jpg',
          'assets/images/games/game.jpg',
      ];
  } else {
      $images = array_map(function ($image) use ($gameFolderPath) {
          return $gameFolderPath . '/' . $image;
      }, $images);
      return $images;
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
              <li><a href="index.php">Home</a></li>
              <li><a href="browse.php" class="active">Browse</a></li>
              <li><a href="streams.php">Streams</a></li>
              <li><a href="profile.php">Profile <img src="<?php echo getProfilePicture($connectedUser) ?>" alt ="Profile Picture">
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
          </nav>
        </div>
      </div>
    </div>
</header>