<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Travel Agency</title>
    <link rel="stylesheet" href="assets/stylesheets/general-styles.css" />
    <link rel="stylesheet" href="assets/stylesheets/hamburgers.css" />

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

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script src="assets/scripts/header.js" defer></script>
    <style>
      .developer-tools-section {
        padding: 8rem 0 18rem;
      }
    </style>
  </head>
  <body>
    <?php
      require_once("header.php");

      if(!isset($_SESSION['developer'])){
        $_SESSION['error'] = "You need to login as admin!";
        header("Location: login.php");
        exit();
      }

      require_once("database.php");

      if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger" role="alert" id="alertMessage">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
      
    if (isset($_SESSION['success'])) {
      echo '<div class="alert alert-success" role="alert" id="alertMessage">' . $_SESSION['success'] . '</div>';
      unset($_SESSION['success']);
  }

    ?>
    <section class="developer-tools-section">
      <div class="container text-center">
        <div class="row mb-5">
          <h1 class="fs-1 fw-bold">Manage System</h1>
        </div>
        <div class="row">
          <div class="col">
            <a href="addPackage.php" class="btn btn-success">Add Package</a>
          </div>
          <div class="col">
            <a href="managePackages.php" class="btn btn-primary">Manage Packages</a>
          </div>
          <div class="col">
            <a href="manageReservations.php" class="btn btn-danger">Manage Booking</a>
          </div>
          <div class="col">
            <a href="manageUsers.php" class="btn btn-info">Manage Users</a>
          </div>
        </div>
      </div>
    </section>
    <?php
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
