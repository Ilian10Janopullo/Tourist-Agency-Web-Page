<?php

session_start();

require_once("database.php");

if (!isset($_SESSION["developer"])) {
    $_SESSION['error'] = "You need to login as admin!";
    header("Location: login.php");
    exit();
}

$reservationId = $_GET['id'];

if(!isset($reservationId)){
    header("Location: manageReservations.php");
    exit();
}

$kids = intval($_POST["kids"]);
$adults = intval($_POST["adults"]);
$dateFrom = new DateTime($_POST["date-from"]);
$dateTo = new DateTime($_POST["date-to"]);
$packageId = intval($_POST["submit"]);

$query = "SELECT city, adultPrice, kidsPrice FROM packages WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $packageId);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($place, $adultPrice, $kidsPrice);
$stmt->fetch();

$interval = $dateFrom->diff($dateTo);
$days = $interval->days;

$price = ($adultPrice * $adults + $kidsPrice * $kids) * $days;

$stmt->free_result();

$formattedFromDate = $dateFrom->format('Y-m-d');
$formattedToDate = $dateTo->format('Y-m-d');

$currentDate = new DateTime();
$formattedCurrentDate = $currentDate->format('Y-m-d');

if($formattedFromDate >= $formattedToDate || $formattedFromDate < $formattedCurrentDate){
    $_SESSION['error'] = "Invalid Dates!";
    header("Location: manageReservations.php");
    exit();
}

$query = "UPDATE reservations SET adults=? , kids=?, fromDate=?, toDate=?, place=? , totalPrice= ? WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('iisssii', $adults, $kids, $formattedFromDate, $formattedToDate, $place, $price, $reservationId);
$stmt->execute();
$stmt->free_result();

if ($stmt->affected_rows == 0) {
    $_SESSION['error'] = "Error processing your reservation.";
    header("Location: manageReservations.php");
    exit();
}

$db->close();

$_SESSION['success'] = "The reservations is edited successfully! New total price is : $price $";
header("Location: manageReservations.php");
exit();

?>
