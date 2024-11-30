<?php 

    $reservationId = $_POST["reservationId"];

    require_once("database.php");

    $query = "DELETE FROM reservations WHERE id = ?";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("i", $reservationId);
    $stmt -> execute();

    $stmt ->free_result();
    $db -> close();

    $_SESSION['success'] = "Reservation is delete successfully!";
    header("Location: manageReservations.php");  
    exit();  
?>