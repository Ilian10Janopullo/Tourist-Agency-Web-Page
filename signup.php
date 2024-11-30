<?php
session_start();

if (isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Travel Agency</title>
    <link rel="stylesheet" href="assets/stylesheets/main-styles.css">
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            padding: 50px 20px;
            margin: 0;
            background-color: #ffffff;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 20px;
            width: calc(100% - 40px); /* Adjust width considering padding and margin */
            box-sizing: border-box;
            opacity: 1;
            transition: opacity 0.5s ease-out;
            position: absolute; /* Set the position to absolute to ensure it's always on top */
            top: 10px; /* Adjust this value based on your header or desired distance from top */
            z-index: 1000; /* Ensures the alert is above other elements */
        }

        main {
            position: relative; /* Needed since the alert is absolutely positioned relative to this container */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #f6f6f6;
            width: min(850px, 95%);
            border-radius: 20px;
            min-height: 90vh;
            gap: 50px;
            background-color: #ffffff;
            padding-top: 60px; /* Add padding to top to ensure content doesn't hide under the alert */
        }

        .content-container {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
        }

        .left-side1 {
            flex: 1;
            height: 500px;
            background-image: url("assets/images/logo.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            pointer-events: none;
            margin-right: 45px;
            width: 50%;
            border-radius: 20px;
            background-color: #ffffff;
            border: 1px solid black;
        }

        .form-container {
            flex: 1;
            background-color: none;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            background-color: #ffffff;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 11px;
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <main>
        <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert" id="alertMessage">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>
        <div class="content-container">
            <div class="left-side1"></div>
            <div class="form-container">
                <form method = "post" action = "signUpProcessing.php">
                    <label for="name">Name:</label>
                    <input type="text" id="name" placeholder="Enter Name" name="name" required />

                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" placeholder="Enter Surname" name="surname" required />

                    <label for="email">Email:</label>
                    <input type="text" id="email" placeholder="Enter Email" name="email" required />

                    <label for="password">Password:</label>
                    <input type="password" id="password" placeholder="Enter Password" name="password" required minlength="8"/>

                    <button type="submit" class="login-btn">Sign Up</button>
                </form>
                <div class="links">
                        <a href="login.php">Have an account?</a><br />
                        <a href="index.php">Continue without an account!</a>
                    </div>
            </div>
        </div>
    </main>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            setTimeout(function() {
                alertMessage.style.opacity = '0';
                setTimeout(function() {
                    alertMessage.remove();
                }, 500); // Wait for the transition to finish before removing
            }, 5000); // 10 seconds
        }
    });
</script>
</body>

</html>
