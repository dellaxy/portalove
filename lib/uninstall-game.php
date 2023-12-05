<?php

include_once "database.php";

use CYBORG\Lib\Database;

$db = new Database();

if (isset($_POST['gameId']) && isset($_POST['userId'])) {
    $gameId = $_POST['gameId'];
    $userId = $_POST['userId'];

    $db->uninstallGame($gameId, $userId);
}

?>