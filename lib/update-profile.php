<?php
session_start();

include_once "database.php";

use CYBORG\Lib\Database;

$db = new Database();

$errorResponse = array(
    'status' => 'success',
    'message' => ''
);

if(isset($_POST['userId'])){
    if (isset($_POST['nickname']) && $_POST['nickname'] != '') {
        $userId = intval($_POST['userId']);
        $nickname = $_POST['nickname'];
        $bio = $_POST['bio'];
        try {
            $db->updateProfileInfo($userId, $nickname, $bio);
            $_SESSION['loggedInUser'] = $db->getProfileData($_SESSION['loggedInUser']['unique_name']);
        } catch (Exception $e) {
            $errorResponse['status'] = 'error';
            $errorResponse['message'] = 'An unexpected error occurred. Please try again later.';
        }
    } else {
        $errorResponse['status'] = 'error';
        $errorResponse['message'] = 'Required fields not provided';
    }
}
 else {
    $errorResponse['status'] = 'error';
    $errorResponse['message'] = 'User could not be found.';
}

header('Content-Type: application/json');
echo json_encode($errorResponse);

?>