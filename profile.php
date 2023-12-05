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

  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profileId = intval($_GET['id']);
    $profileInfo = $db->getProfileData($profileId);
  } else {
    if(isUserLoggedIn()){
      $profileInfo = $currentUser;
    } else {
      exit;
    }
  }

  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <!-- ***** Banner Start ***** -->
          <div class="row">
            <div class="col-lg-12">
              <div class="main-profile ">
                <div class="row">
                  <div class="col-lg-4">
                    <img src="<?php echo getProfilePicture($profileInfo) ?>" alt="" style="border-radius: 23px;">
                  </div>
                  <div class="col-lg-4">
                    <div class="main-info header-text">
                      <span>Offline</span>
                      <h2><?php echo $profileInfo['nickname'] ?></h2>
                      <p class="mt-3 fs-5"><?php echo $profileInfo['bio'] ?></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <ul>
                      <li>Games Downloaded <span><?php echo $profileInfo['games_count'] ?></span></li>
                      <li>Following <span><?php echo $profileInfo['following_count'] ?></span></li>
                      <li>Clips <span>29</span></li>
                      <?php 
                        if (isUserLoggedIn() && $profileInfo['id'] != $currentUser['id']){
                        echo
                        '<li><div class="main-border-button"><a href="">Follow</a></div></li>';
                        }
                      ?>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="clips">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="heading-section">
                            <h4><em>Your Most Popular</em> Clips</h4>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img src="assets/images/clip-01.jpg" alt="" style="border-radius: 23px;">
                              <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i
                                  class="fa fa-play"></i></a>
                            </div>
                            <div class="down-content">
                              <h4>First Clip</h4>
                              <span><i class="fa fa-eye"></i> 250</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img src="assets/images/clip-02.jpg" alt="" style="border-radius: 23px;">
                              <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i
                                  class="fa fa-play"></i></a>
                            </div>
                            <div class="down-content">
                              <h4>Second Clip</h4>
                              <span><i class="fa fa-eye"></i> 183</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img src="assets/images/clip-03.jpg" alt="" style="border-radius: 23px;">
                              <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i
                                  class="fa fa-play"></i></a>
                            </div>
                            <div class="down-content">
                              <h4>Third Clip</h4>
                              <span><i class="fa fa-eye"></i> 141</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <div class="item">
                            <div class="thumb">
                              <img src="assets/images/clip-04.jpg" alt="" style="border-radius: 23px;">
                              <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i
                                  class="fa fa-play"></i></a>
                            </div>
                            <div class="down-content">
                              <h4>Fourth Clip</h4>
                              <span><i class="fa fa-eye"></i> 91</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="main-button">
                            <a href="#">Load More Clips</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="gaming-library profile-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Your Gaming</em> Library</h4>
              </div>

              <?php
                $downloadedGames = $db->getProfileGames($profileInfo['id']);

                foreach($downloadedGames as $game){
                  echo
                  '<div class="item">
                  <ul>
                    <li><img src="'. getGameHeader($game['game_header']) .'" alt="" class="templatemo-item"></li>
                    <li>
                      <h4>'. $game['name'] .'</h4><span>'. $game['category'] .'</span>
                    </li>
                    <li>
                      <h4>Date Added</h4><span>22/06/2036</span>
                    </li>
                    <li>
                      <h4>Hours Played</h4><span>745 H 22 Mins</span>
                    </li>
                    <li></li>';
                      if(isUserLoggedIn()){
                        echo '<li><div class="main-border-button"><a href="#" onclick="uninstallGame(' . $game['id'] . ', ' . $currentUser['id'] . ')">Uninstall</a></div></li>';
                      }
                    echo '</ul>
                </div>';
                }
                        

              ?>
            </div>
          </div>
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