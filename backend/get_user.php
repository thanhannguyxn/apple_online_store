<?php
session_start();
include('db.php');

if (isset($_SESSION['user'])) {
    echo json_encode([
        'success' => true,
        'user' => $_SESSION['user'] 
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in'
    ]);
}
?>

