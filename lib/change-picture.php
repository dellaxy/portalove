<?php
session_start();

include_once "database.php";

use CYBORG\Lib\Database;

$db = new Database();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_FILES['profile-picture'] !== null && $_FILES['profile-picture']['error'] === UPLOAD_ERR_OK){
        $targetDir = "../assets/images/profiles/";
        $fileName = $_SESSION['loggedInUser']['unique_name'] .'-'. basename($_FILES['profile-picture']['name']);
        $targetPath = $targetDir . $fileName;

        $oldFileName = $_SESSION['loggedInUser']['profile_picture'];

        if (move_uploaded_file($_FILES['profile-picture']['tmp_name'], $targetPath)) {
            if($oldFileName !== 'default.png' && file_exists($targetDir . $oldFileName)){
                unlink($targetDir . $oldFileName);
            }
            $db->updateProfilePicture($_SESSION['loggedInUser']['id'], $fileName);
            $_SESSION['loggedInUser']['profile_picture'] = $fileName;
            exit();
        }
    } else {
        exit();
    }
}


?>