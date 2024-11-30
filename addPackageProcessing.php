<?php

session_start();

if(!isset($_SESSION['developer'])){
    $_SESSION['error'] = "You need to login as admin!";
    header("Location: login.php");
    exit();
  }

    require_once("database.php");

    $city = trim($_POST["city"]);
    $description = trim($_POST["description"]);
    $aPrice = trim($_POST["adults-price"]);
    $imageLink = ($_POST["image-link"]);
    $kPrice = trim($_POST["kids-price"]);
    $category = $_POST["category"];


    if(!isset($city )|| !isset($description) || !isset($imageLink) || !isset($aPrice) || !isset($kPrice) || !isset($category) ){
        header("Location: addPackage.php");
        exit();
    }


    $query = "INSERT INTO packages (city, description, category, adultPrice, kidsPrice, imageLink) VALUES (?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssiis', $city, $description, $category, $aPrice, $kPrice, $imageLink);
    $stmt->execute();

    if($stmt->affected_rows == 0){
        $_SESSION['error'] = "Insertion of package to database failed!";
        header("Location: developer.php");
        exit();
    }

    $stmt ->free_result();
    $db ->close();

    $_SESSION['success'] = "Insertion of package to database is successful!";
    header("Location: developer.php");
    exit();

?>