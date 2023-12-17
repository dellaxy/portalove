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

    <?php include_once "parts/navigation.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">

                    <div class="live-stream">
                        <div class="col-lg-12">
                            <div class="heading-section">
                                <h4>All games</h4>
                            </div>
                        </div>
                        <div class="row">
                            <?php

                            $allGames = $db->getAllGames();
                            foreach ($allGames as $game) {

                            echo
                                '<div class="col-lg-3 col-sm-6">
                                    <div class="item">
                                    <a href="details.php?id=' . $game['id'] . '" class="no-styles">
                                        <div class="thumb">
                                            <img src="'.getGameHeader($game['game_header']).'" alt="">
                                            <div class="hover-effect">
                                                <div class="content">
                                                    <ul>
                                                        <li><a href=""><i class="fa fa-eye"></i> 1.2K</a></li>
                                                        <li><a href=""><i class="fa fa-gamepad"></i> ' . $game['category'] . '</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="down-content d-flex justify-content-center">
                                            <h4>' . $game['name'] . '</h4>
                                        </div>
                                    </div>
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