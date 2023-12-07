<?php
session_start();
include_once "database.php";

use CYBORG\Lib\Database;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new Database();

    $errorResponse = array(
        'status' => 'error',
        'message' => ''
    );

    if(isset($_POST['uniqueName']) && isset($_POST['password'])){
        $uniqueName = $_POST['uniqueName'];
        $password = $_POST['password'];

        $result = $db->getProfileData($uniqueName);

        if($result && password_verify($password, $result['password'])){
            $_SESSION['loggedInUser'] = $result;
            header("Location: ../index.php");
        } else {
            $errorResponse['message'] = 'Invalid credentials.';
        }

    } else {
        $errorResponse['message'] = 'Fields cannot be empty.';
    }
} else {
    header("Location: ../login.php");
}
header('Content-Type: application/json');
echo json_encode($errorResponse);
?>