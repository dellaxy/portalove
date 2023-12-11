<?php
session_start();
include_once "database.php";

use CYBORG\Lib\Database;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new Database();

    $errorResponse = array(
        'status' => 'success',
        'message' => ''
    );
    
    if (isset($_POST['nickname']) && isset($_POST['uniqueName']) && isset($_POST['password'])) {
        $nickname = $_POST['nickname'];
        $uniqueName = $_POST['uniqueName'];
        try{
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $registrationError = $db->createAccount($nickname, $uniqueName, $password);
            if($registrationError){
                $errorResponse['status'] = 'error';
                $errorResponse['message'] = $registrationError;
            }
        } catch (Exception $e) {
            $errorResponse['status'] = 'error';
            $errorResponse['message'] = 'An unexpected error occurred. Please try again later.';
        }
    } else {
        $errorResponse['status'] = 'error';
        $errorResponse['message'] = 'Fields cannot be empty.';
    }
} else {
    header("Location: ../create-account.php");
    exit();
}
header('Content-Type: application/json');
echo json_encode($errorResponse);
?>