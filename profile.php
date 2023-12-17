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

  if (isset($_GET['user'])) {
    $profileUnique = $_GET['user'];
    $profileInfo = $db->getProfileData($profileUnique);
    if(empty($profileInfo)){
      header("Location: index.php");
    }
  } else {
    if(isUserLoggedIn()){
      $profileInfo = $currentUser;
    } else {
      header("Location: login.php");
    }
  }

  ?>

  <div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profileEditModal">Modal Title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="profileUpdateForm" onsubmit="submitProfileEditForm(event)">
          <input type="hidden" id="profile-userId" name="userId">
          <div class="form-group">
            <label for="profile-nickname" class="col-form-label">Username</label>
            <input type="text" class="form-control" id="profile-nickname" name="nickname" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="profile-bio" class="col-form-label">Bio</label>
            <textarea class="form-control" id="profile-bio" name="bio" rows="5" style="resize:none;" autocomplete="off"></textarea>
          </div>
        </div>
        <div class="error-message text-danger text-center"></div>
        <div class="modal-footer">
        <button type="submit" class="btn">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profileModalLabel">Followed accounts</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <?php
              $followings = $db->getProfileFollowings($profileInfo['id']);
              foreach($followings as $following){
                echo '<li class="list-group-item" style="display: flex; align-items: center;">
                <img src="'.getProfilePicture($following).'" alt="Profile Picture">
                <a href="profile.php?user='.$following['unique_name'].'">' . $following['nickname'] . '</a>
              </li>';
        
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="profilePictureModal" tabindex="-1" role="dialog" aria-labelledby="profilePictureModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center">
          <img id="preview" src="<?php echo getProfilePicture($profileInfo) ?>" alt="Current Profile Picture" style="border-radius: 23px; height: 400px; width: 450px; object-fit: cover;">
          <input type="file" id="profile-picture" name="profile-picture" accept="image/*" onchange="previewImage()" class="mt-4">
        </div>
        <div class="text-center mt-3">
          <button class="btn btn-primary" onclick="changeProfilePicture()">Change Picture</button>
        </div>
      </div>  
    </div>
  </div>
</div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="main-profile ">
                <div class="row">
                  <div class="col-lg-4">
                    <?php

                      if($profileInfo['id'] == $currentUser['id']){
                        echo
                        '<div class="profile-picture" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#profilePictureModal">
                          <img src="'. getProfilePicture($profileInfo) .'" alt="" style="border-radius: 23px; aspect-ratio: 1/1;object-fit: cover;">
                        </div>';
                      } else {
                        echo
                        '<div class="profile-picture">
                          <img src="'. getProfilePicture($profileInfo) .'" alt="" style="border-radius: 23px; aspect-ratio: 1/1;object-fit: cover;">
                        </div>';
                      }
                    ?>
                  </div>
                  <div class="col-lg-4">
                    <div class="main-info header-text">
                    <div class="row">
                        <h2 class="col-10 text-break"><?php echo $profileInfo['nickname'] ?></h2>
                        <div class="col-1 d-flex justify-content-center align-items-center mx-1">
                          <?php
                          if(isUserLoggedIn() && $profileInfo['id'] == $currentUser['id']){
                            echo
                              '<i class="fa-solid fa-pencil fa-xl edit-icon" title="Edit profile" onclick="openProfileEditModal('. htmlspecialchars(json_encode($currentUser), ENT_QUOTES, 'UTF-8') .')"></i>';
                          };
                          ?>
                        </div>
                    </div>
                        <p class="mt-4 fs-5 text-break"><?php echo $profileInfo['bio'] ?></p>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <ul>
                      <li>Games Downloaded <span><?php echo $profileInfo['games_count'] ?></span></li>
                      <li style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#followingModal">Following<span><?php echo $profileInfo['following_count'] ?></span></li>
                      <li>Clips <span>29</span></li>
                      <?php 
                        if (isUserLoggedIn() && $profileInfo['id'] != $currentUser['id']){
                          $following = $db->getProfileFollowings($currentUser['id']);
                          if(in_array($profileInfo['id'], array_column($following, 'id'))){
                            echo
                            '<li><div class="main-border-button"><a href="" onclick="unfollowProfile(' . $currentUser['id'] . ', ' . $profileInfo['id'] . ')">Unfollow</a></div></li>';
                          } else {
                            echo
                            '<li><div class="main-border-button"><a href="" onclick="followProfile(' . $currentUser['id'] . ', ' . $profileInfo['id'] . ')">Follow</a></div></li>';
                          }
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
                      if(isUserLoggedIn() && $profileInfo['id'] == $currentUser['id']){
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

</body>

</html>