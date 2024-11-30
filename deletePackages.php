<?php

session_start();

if (!isset($_SESSION["developer"])) {
    $_SESSION['error'] = "You need to login as admin!";
    header("Location: login.php");
    exit();
}

    $id = $_GET["id"];

    if(!isset($id)){
        header("Location: managePackages.php");
        exit();
    }

    require_once("database.php");

    $query = "DELETE FROM packages WHERE id = ?";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("i", $id);
    $stmt -> execute();

    $stmt ->free_result();
    $db -> close();

    $_SESSION['success'] = "Package is delete successfully!";
    header("Location: managePackages.php");  
    exit();  
?>