<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <title>Cyborg - Awesome HTML5 Template</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>

  <?php

  include_once "parts/navigation.php";


  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <div class="main-banner">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Welcome To Cyborg</h6>
                  <h4><em>Browse</em> Our Popular Games Here</h4>
                  <div class="main-button">
                    <a href="browse.php">Browse Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="most-popular">
            <div class="row">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>Most Popular</em> Right Now</h4>
                </div>
                <div class="row">

                  <?php
                  $popularGames = $db->getMostPopularGames();
                  foreach ($popularGames as $game) {
                    echo
                    '<div class="col-lg-4 col-sm-6">
                    <a href="details.php?id=' . $game['id'] . '">
                      <div class="item">
                        <img src="'. getGameHeader($game['game_header']) .'" alt="" class="game-card-img">
                        <h4>' . $game['name'] . '<br><span>' . $game['category'] . '</span></h4>
                        <ul>
                          <li><i class="fa fa-star"></i> ' . $game['average_rating'] . '</li>
                          <li><i class="fa fa-download"></i> ' . formatDownloads($game['downloads']) . '</li>
                        </ul>
                      </div>
                      </a>
                    </div>';
                  }
                  ?>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Most Recent</em> Games</h4>
              </div>
                <?php 
                
                $newestGames = $db->getMostRecentGames();

                foreach ($newestGames as $game) {
                  $profileGames = isUserLoggedIn() ? $db->getDownloadedGames($currentUser['id']) : [];
                  echo
                  '<div class="item">
                  <ul>
                    <li><img src="'. getGameHeader($game['game_header']) .'" alt="" class="templatemo-item"></li>
                    <li>
                      <h4>'. $game['name'] .'</h4><span>'. $game['category'] .'</span>
                    </li>
                    <li>
                      <h4>Release Date</h4><span>'. $game['release_date'] .'</span>
                    </li>
                    <li></li>
                    <li> </li>
                    <li>';
                    if (isUserLoggedIn()) {
                      if (in_array($game['id'], array_column($profileGames, 'game_id'))) {
                        echo '<div class="main-border-button"><a href="profile.php">In Library</a></div>';
                      } else {
                        echo '<div class="main-border-button"><a href="#" onclick="downloadGame(' . $game['id'] . ', ' . $currentUser['id'] . ')">Download</a></div>';
                      }
                    } else {
                        echo '<div class="main-border-button"><a href="login.php">Download</a></div>';
                    }
                    echo '</li>
                        </ul>
                    </div>';
                }

                ?>

            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="profile.php">View Your Library</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include_once "parts/footer.php"; ?>


  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>