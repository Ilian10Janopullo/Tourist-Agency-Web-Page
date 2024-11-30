<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Travel Agency</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/stylesheets/general-styles.css">
  <link rel="stylesheet" href="assets/stylesheets/main-page-styles.css">
  <link rel="stylesheet" href="assets/stylesheets/hamburgers.css">
  
  <style>
      .alert {
          padding: 10px;
          border-radius: 5px;
          text-align: center;
          width: 450px; /* Adjust width considering padding and margin */
          box-sizing: border-box;
          opacity: 1;
          transition: opacity 0.5s ease-out;
          top: 70px; /* Adjust this value based on your header or desired distance from top */
          left: 50%; /* Center horizontally */
          transform: translateX(-50%); /* Center horizontally */
          z-index: 1000; /* Ensures the alert is above other elements */
      }
    </style>
  
  <script src="assets/scripts/header.js" defer></script>
</head>
<body>
  <?php
    require_once("header.php");
        
    if (isset($_SESSION['error'])) {
      echo '<div class="alert alert-danger" role="alert" id="alertMessage">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']);
    }

    require_once("main.html");
    require_once("footer.html");
  ?>

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