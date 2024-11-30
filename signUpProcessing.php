<?php

    session_start();

    if (isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    require_once("database.php");

    $name = trim($_POST["name"]);
    $surname = trim($_POST["surname"]);
    $email = trim($_POST["email"]);
    $password = md5($_POST["password"]);
    $status = 0;

    if(!$name || !$surname || !$email || !$password ){
        $_SESSION['error'] = "Fields are not filled!";
        header("Location: signup.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE email = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    while($stmt->fetch()){

    }

    if($stmt->num_rows() > 0){
        $_SESSION['error'] = "This email is already in use!";
        header("Location: signup.php");
        exit();
    }

    $query = "INSERT INTO users (name, surname, email, password, status) VALUES (?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $name, $surname, $email, $password, $status);
    $stmt->execute();

    if($stmt->affected_rows == 0){
        $_SESSION['error'] = "Insertion into database failed!";
        header("Location: signup.php");
        exit();
    }

    $_SESSION["email"] = $email;
     $_SESSION['token'] = bin2hex(random_bytes(32));

    $stmt ->free_result();
    $db ->close();

    header("Location: index.php");
?>