<?php

session_start();

require_once("database.php");

if (!isset($_SESSION["email"])) {
    $_SESSION['error'] = "You are not logged in.";
    header("Location: login.php");
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
$stmt->fetch(); // Assuming only one row is returned

$interval = $dateFrom->diff($dateTo);
$days = $interval->days;

$price = ($adultPrice * $adults + $kidsPrice * $kids) * $days;

$stmt->free_result();

$query = "SELECT name, surname FROM users WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $surname);
$stmt->fetch();
$stmt->free_result();

$formattedFromDate = $dateFrom->format('Y-m-d');
$formattedToDate = $dateTo->format('Y-m-d');

$currentDate = new DateTime();
$formattedCurrentDate = $currentDate->format('Y-m-d');

if($formattedFromDate >= $formattedToDate || $formattedFromDate < $formattedCurrentDate){
    $_SESSION['error'] = "Invalid Dates!";
    header("Location: packages.php");
    exit();
}

$query = "INSERT INTO reservations (name, surname, email, adults, kids, fromDate, toDate, place, totalPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('sssiisssi', $name, $surname, $_SESSION['email'], $adults, $kids, $formattedFromDate, $formattedToDate, $place, $price);
$stmt->execute();
$stmt->free_result();

if ($stmt->affected_rows == 0) {
    $_SESSION['error'] = "Error processing your reservation.";
    header("Location: packages.php");
    exit();
}

$db->close();

$_SESSION['success'] = "Your reservation is confirmed! Total price is : $price $";
header("Location: packages.php");
exit();

?>
