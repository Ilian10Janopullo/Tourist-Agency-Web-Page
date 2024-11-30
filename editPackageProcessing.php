<?php

session_start();

if(!isset($_SESSION['developer'])){
    $_SESSION['error'] = "You need to login as admin!";
    header("Location: login.php");
    exit();
  }

    require_once("database.php");

    $packageId = intval($_POST['submit']);

    $city = trim($_POST["city"]);
    $description = trim($_POST["description"]);
    $aPrice = trim($_POST["adults-price"]);
    $imageLink = ($_POST["image-link"]);
    $kPrice = trim($_POST["kids-price"]);
    $category = $_POST["category"];


    if(!isset($city )|| !isset($description) || !isset($imageLink) || !isset($aPrice) || !isset($kPrice) || !isset($category) ){
        header("Location: managePackages.php");
        exit();
    }


    $query = "UPDATE packages SET city=?, description=?, category=?, adultPrice=?, kidsPrice=?, imageLink=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssiisi', $city, $description, $category, $aPrice, $kPrice, $imageLink, $packageId);
    $stmt->execute();

    if($stmt->affected_rows == 0){
        $_SESSION['error'] = "Editing of package to database failed!";
        header("Location: managePackages.php");
        exit();
    }

    $stmt ->free_result();
    $db ->close();

    $_SESSION['success'] = "Editing of package to database is successful!";
    header("Location: managePackages.php");
    exit();

?>