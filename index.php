<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <title>Cyborg - Awesome HTML5 Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <!--

TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming

-->
</head>

<body>

  <?php

  include_once "parts/navigation.php";


  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <!-- ***** Banner Start ***** -->
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
          <!-- ***** Banner End ***** -->

          <!-- ***** Most Popular Start ***** -->
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
                    </div>';
                  }
                  ?>



                </div>
              </div>
            </div>
          </div>
          <!-- ***** Most Popular End ***** -->

          <!-- ***** Gaming Library Start ***** -->
          <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Your Gaming</em> Library</h4>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/game-03.jpg" alt="" class="templatemo-item"></li>
                  <li>
                    <h4>CS-GO</h4><span>Sandbox</span>
                  </li>
                  <li>
                    <h4>Date Added</h4><span>21/04/2036</span>
                  </li>
                  <li>
                    <h4>Hours Played</h4><span>892 H 14 Mins</span>
                  </li>
                  <li>
                    <h4>Currently</h4><span>Downloaded</span>
                  </li>
                  <li>
                    <div class="main-border-button border-no-active"><a href="#">Donwloaded</a>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/game-02.jpg" alt="" class="templatemo-item"></li>
                  <li>
                    <h4>Fortnite</h4><span>Sandbox</span>
                  </li>
                  <li>
                    <h4>Date Added</h4><span>22/06/2036</span>
                  </li>
                  <li>
                    <h4>Hours Played</h4><span>740 H 52 Mins</span>
                  </li>
                  <li>
                    <h4>Currently</h4><span>Downloaded</span>
                  </li>
                  <li>
                    <div class="main-border-button"><a href="#">Donwload</a></div>
                  </li>
                </ul>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/game-03.jpg" alt="" class="templatemo-item"></li>
                  <li>
                    <h4>CS-GO</h4><span>Sandbox</span>
                  </li>
                  <li>
                    <h4>Date Added</h4><span>21/04/2036</span>
                  </li>
                  <li>
                    <h4>Hours Played</h4><span>892 H 14 Mins</span>
                  </li>
                  <li>
                    <h4>Currently</h4><span>Downloaded</span>
                  </li>
                  <li>
                    <div class="main-border-button border-no-active"><a href="#">Donwloaded</a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="profile.php">View Your Library</a>
              </div>
            </div>
          </div>
          <!-- ***** Gaming Library End ***** -->
        </div>
      </div>
    </div>
  </div>

  <?php include_once "parts/footer.php"; ?>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>


</body>

</html>