<?php

session_start();
if(!isset($_SESSION['developer'])){
    $_SESSION['error'] = "You need to login as admin!";
    header("Location: login.php");
    exit();
}

require_once("database.php");
$userID = intval($_POST['submit']);  // Ensure this is the right field, might want to use a hidden field for userID instead.
$name = trim($_POST["name"]);
$surname = trim($_POST["surname"]);
$email = trim($_POST["email"]);
$status = trim($_POST["status"]);

// Initialize a flag to determine whether to update the password.
$updatePassword = false;
$password = "";
if (isset($_POST["password"]) && trim($_POST["password"]) != '') {
    $password = md5($_POST["password"]);
    $updatePassword = true;
}

// Prepare and bind parameters based on whether the password needs to be updated.
if ($updatePassword) {
    $query = "UPDATE users SET name=?, surname=?, email=?, password=?, status=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssssii', $name, $surname, $email, $password, $status, $userID);
} else {
    $query = "UPDATE users SET name=?, surname=?, email=?, status=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssii', $name, $surname, $email, $status, $userID);
}

$stmt->execute();

if ($stmt->affected_rows == 0) {
    $_SESSION['error'] = "Editing of user to database failed!";
    header("Location: manageUsers.php");
    exit();
}

$stmt->free_result();
$db->close();

$_SESSION['success'] = "Editing of user to database is successful!";
header("Location: manageUsers.php");
exit();

    
?>