<?php

include_once "database.php";

use CYBORG\Lib\Database;

$db = new Database();

$errorResponse = array(
    'status' => 'success',
    'message' => ''
);
error_log('Received POST data: ' . print_r($_POST, true));

if(isset($_POST['userId'])){
    if (isset($_POST['nickname'])) {
        $userId = intval($_POST['userId']);
        $nickname = $_POST['nickname'];
        $bio = $_POST['bio'];
        try {
            $db->updateProfileInfo($userId, $nickname, $bio);
        } catch (Exception $e) {
            $errorResponse['message'] = 'An unexpected error occurred. Please try again later.';
        }
    } else {
        $errorResponse['message'] = 'Rquired fields not provided';
    
    }
}
 else {
    $errorResponse['message'] = 'User could not be found.';
}

header('Content-Type: application/json');
echo json_encode($errorResponse);

?>