<?php
session_start();

if (isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

require_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = md5($_POST['password']);

    // Regex pattern for email validation
    $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    // Validate email format
    if (!preg_match($emailPattern, $email)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: login.php");
        exit();
    }

    $query = "SELECT id, email, password, status FROM users WHERE email = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $dbEmail, $dbPassword, $status);

    if ($stmt->num_rows != 1) {
        $_SESSION['error'] = "Incorrect email or password.";
        header("Location: login.php");
        exit();
    } else {
        
        $stmt->fetch();
        if($status == 1){
            $_SESSION["developer"] = $id; 
        }
        
        $_SESSION["email"] = $email;
        $_SESSION['token'] = bin2hex(random_bytes(32));
        header("Location: index.php");
        exit();
    }
}
?>
