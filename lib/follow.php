<?php
session_start();

include_once "database.php";

use CYBORG\Lib\Database;

$db = new Database();

if (isset($_POST['profileId']) && isset($_POST['followingId'])) {
    $profileId = $_POST['profileId'];
    $followingId = $_POST['followingId'];

    $db->followProfile($profileId, $followingId);

    $_SESSION['loggedInUser'] = $db->getProfileData($_SESSION['loggedInUser']['unique_name']);

}

?>