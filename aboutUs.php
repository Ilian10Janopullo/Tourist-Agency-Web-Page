<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Travel Agency</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/stylesheets/general-styles.css">
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
      .about-us-image-section{
        padding: 7rem 0 6rem;
        min-height: 550px;
        background-position: 0% 20%;
        background-image: linear-gradient(rgb(0, 0, 0, 0.6), rgb(0,0,0, 0.6)),
        url("/assets/images/about-us-image1.jpg");
        background-size: cover;
      }
      .about-us-text-section{
        padding: 7rem 0 6rem;
      }
      .about-us-text-section h2{
        color: #A3101D;
      }
      .about-us-text-section p{
        font-size: 1.125rem;
        line-height: 1.5;
      }
      .about-us-text-section > .d-flex{
        gap: 2rem;
        margin-bottom: 5rem;
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
  ?>

  <section class="about-us-image-section d-flex justify-content-center align-items-center">
    <div class="container text-center">
      <h1 class="fs-1 fw-bold text-white lh-1">About Us</h1>
    </div>
  </section>

  <section class="about-us-text-section">
    <div class="container d-flex">
      <div class="w-100 d-flex flex-column justify-content-center">
        <h2 class="fs-2">What we do</h2>
        <p>At Ares Travel, we specialize in crafting unforgettable travel experiences tailored to your unique desires. Our comprehensive travel services range from curated vacation packages to booking solutions, all designed to make your journey effortless and enjoyable. Whether you're dreaming of a beach retreat, a mountain expedition, or a city exploration, our expert team works tirelessly to ensure every detail is perfect.</p>
      </div>
      <img src="/assets/images/what-we-do.avif" alt="plane flying" class="w-100">
    </div>
    <div class="container d-flex">
    <img src="/assets/images/our-vision.avif" alt="plane flying" class="w-100">
      <div class="w-100 d-flex flex-column justify-content-center">
        <h2 class="fs-2">Our Vision</h2>
        <p>Our vision at Ares Travel is to inspire and empower travelers to discover the beauty and diversity of the world. We believe in the transformative power of travel and strive to create meaningful experiences through it. By combining cutting-edge technology with personalized service, we aim to revolutionize the way people explore the globe.</p>
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