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

    if(isset($_POST['uniqueName']) && isset($_POST['password'])){
        $uniqueName = $_POST['uniqueName'];
        $password = $_POST['password'];

        $result = $db->getProfileData($uniqueName);

        if($result && password_verify($password, $result['password'])){
            $_SESSION['loggedInUser'] = $result;
        } else if (!$result){
            $errorResponse['status'] = 'error';
            $errorResponse['message'] = 'User with this login does not exist.';
        } else {
            $errorResponse['status'] = 'error';
            $errorResponse['message'] = 'Invalid credentials.';
        }

    } else {
        $errorResponse['status'] = 'error';
        $errorResponse['message'] = 'Fields cannot be empty.';
    }
} else {
    header("Location: ../login.php");
    exit();
}
header('Content-Type: application/json');
echo json_encode($errorResponse);
?>