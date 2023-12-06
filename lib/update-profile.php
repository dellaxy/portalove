<?php

include_once "database.php";

use CYBORG\Lib\Database;

$db = new Database();

if (isset($_POST['nickname']) && isset($_POST['bio'])) {
    $nickname = $_POST['nickname'];
    $bio = $_POST['bio'];

    $db->updateProfileInfo($nickname, $bio);
}

?>