<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        
        die("CSRF token mismatch! Logout failed.");
    }
   
    session_destroy();
    header("Location: index.php");
    exit;
} else {
    // Request does not have a POST, redirect to login or error page
    header("Location: index.php");
    exit;
}
?>