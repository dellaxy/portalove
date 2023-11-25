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

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    
</head>

<body>

    <?php 

    include_once "parts/navigation.php"; 

    $gameId = isset($_GET['id']) ? $_GET['id'] : 0;
    $gameDetail = $db->getGameDetail($gameId);

    if (empty($gameDetail)) {
        goBack();
    }
    
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">

                    <!-- ***** Featured Start ***** -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="feature-banner header-text">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <img src="<?php echo getGameHeader($gameDetail['game_header']) ?>" alt="" style="border-radius: 23px; width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="thumb" style="width: 100%; height: 350px; object-fit: cover;">
                                        <iframe width="100%" height="100%" src="<?php echo $gameDetail['trailer_link']?>"></iframe>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Featured End ***** -->

                    <!-- ***** Details Start ***** -->
                    <div class="game-details">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2><?php echo $gameDetail['name']?> Details</h2>
                            </div>
                            <div class="col-lg-12">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="right-info">
                                                <ul>
                                                    <li><i class="fa fa-star"></i> <?php echo $gameDetail['average_rating']?></li>
                                                    <li><i class="fa fa-download"></i> <?php echo formatDownloads($gameDetail['average_rating'])?></li>
                                                    <li><i class="fa fa-server"></i> <?php echo $gameDetail['size_gb']?> GB</li>
                                                    <li><i class="fa fa-gamepad"></i> <?php echo $gameDetail['category']?></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <?php 
                                        
                                        $gameImages = getGameImage($gameDetail['unique_name']);
                                        foreach ($gameImages as $image) {
                                            echo '<div class="col-lg-4">
                                            <img src="'. $image .'" alt="" style="border-radius: 23px; margin-bottom: 30px;"></div>';
                                        }
                                        ?>
                                        <div class="col-lg-12">
                                            <p><?php echo $gameDetail['description']?></p>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="main-border-button">
                                                <a href="#">Download Fortnite Now!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="other-games">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading-section">
                                    <h4><em>Other Related</em> Games</h4>
                                </div>
                            </div>
                            <?php 
                            
                            $relatedGames = $db->getRelatedGames($gameDetail['category_id'], $gameDetail['id']);

                            foreach ($relatedGames as $game){
                                echo
                                '<div class="col-lg-6">
                                <a href="details.php?id='. $game['id'] .'">
                                    <div class="item">
                                        <img src="assets/images/games/game.jpg" alt="" class="templatemo-item">
                                        <h4 class="fs-5">'. $game['name'] .'</h4>
                                    </div>
                                </div>';
                            }

                            ?>

                        </div>
                    </div>
                    <!-- ***** Other End ***** -->

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