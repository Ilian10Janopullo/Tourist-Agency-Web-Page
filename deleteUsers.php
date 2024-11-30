<?php 
    
    session_start();

    $id = $_POST["id"];

    require_once("database.php");

    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("i", $id);
    $stmt -> execute();

    $stmt ->free_result();
    $db -> close();

    $_SESSION['success'] = "User is deleted successfully!";
    header("Location: manageUsers.php");  
    exit();  
?>