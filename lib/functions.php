<?php

    function isUserLoggedIn() {
        return isset($_SESSION['loggedInUser']);
    }

    function getProfilePicture($profile) {
        $profilePicture =  "assets/images/profiles/".$profile['profile_picture'];
        if (file_exists($profilePicture)) {
            return $profilePicture;
        } else {
            return "assets/images/profiles/default.jpg";
        }
    
    }

    function formatDownloads($count){
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

    function getGameHeader(string $gameHeader) {
        $gameImagePath = 'assets/images/games/' . $gameHeader;
        $defaultImagePath = 'assets/images/games/game.jpg';
    
        return file_exists($gameImagePath) ? $gameImagePath : $defaultImagePath;
    }

    function getGameImage(string $gameUniqueName) {
        $gameFolderPath = 'assets/images/games/' . $gameUniqueName;
        $default = [
            'assets/images/games/game.jpg',
            'assets/images/games/game.jpg',
            'assets/images/games/game.jpg',
        ];

        if (!is_dir($gameFolderPath)) {
            return $default;
        }
        $images = scandir($gameFolderPath);
        $images = array_slice($images, 2);

        if (empty($images)) {
            return $default;
        } else {
            $images = array_map(function ($image) use ($gameFolderPath) {
                return $gameFolderPath . '/' . $image;
            }, $images);
            return $images;
        }
    }

?>
