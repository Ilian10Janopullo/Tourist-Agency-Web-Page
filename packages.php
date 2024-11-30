<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Travel Agency</title>
  <link rel="stylesheet" href="assets/stylesheets/general-styles.css">
  <link rel="stylesheet" href="assets/stylesheets/packages-page.css">
  <link rel="stylesheet" href="assets/stylesheets/hamburgers.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="assets/scripts/header.js" defer></script>
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
</head>
<body>
  <?php
    require_once("header.php");

    require_once("database.php");

    $records_per_page = 6;
    $page = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
      $page = $_GET['page'];
    }
    $offset = ($page - 1) * $records_per_page;


    if(isset($_GET['category'])){
      $cat = $_GET['category'];
      $query = "SELECT * FROM packages WHERE category = '$cat' LIMIT $offset, $records_per_page";
    } else {
      $query = "SELECT * FROM packages LIMIT $offset, $records_per_page";
    }

    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $city, $description, $category, $imageLink, $kidsPrice, $adultPrice);

    if ($stmt->num_rows == 0) {
      echo '<div class="container" style="width: 18rem; align-items: center; margin-left: 420; margin-top: 90px; ; margin-bottom: 90px;">
              <div class="card">
                  <img src="https://static.vecteezy.com/system/resources/thumbnails/007/104/553/small/search-no-result-not-found-concept-illustration-flat-design-eps10-modern-graphic-element-for-landing-page-empty-state-ui-infographic-icon-vector.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                      <p class="card-heading">No packages found!</p>
                  </div>
              </div>
          </div>';
          require_once("footer.html");
      exit();
  }

    if (isset($_SESSION['error'])) {
      echo '<div class="alert alert-danger" role="alert" id="alertMessage">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']);
  }
    
  if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" role="alert" id="alertMessage">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

  ?>

<section class="package-card-section">
  
  <div class="container card-grid">

  <?php

  while ($stmt->fetch()) {

    ?>
      <div class="card-wrapper">
      <div class="package-card rounded-2">
        <div class="card-image-wrapper">
          <img src= <?php echo $imageLink;?> alt=<?php echo $city;?> class="package-card-image"/>
        </div>
        <div class="card-text-wrapper">
          <p class="card-heading"><?php echo $city;?></p>
          <p class="card-description">
          <?php echo $description?>
          </p>
          <div class="prices-wrapper">
            <p><span class="price-kids"><?php echo $kidsPrice;?>$</span> / night for kids</p> 
            <p><span class="price-adults"><?php echo $adultPrice;?>$</span> / night for adults</p>
          </div>
          <a href="book.php?id=<?php echo $id;?>" class="card-button">Book</a>
        </div>
      </div>
    </div>

    <?php
    
}

    ?>
  </div>
</section>

  <?php

    $total_rows_query = "SELECT COUNT(*) FROM packages";
    if (isset($_GET['category'])) {
        $cat = $db->real_escape_string($_GET['category']);  // Prevent SQL Injection
        $total_rows_query .= " WHERE category = '$cat'";
    }
    $result = $db->query($total_rows_query);
    $row = $result->fetch_row();
    $total_rows = $row[0];
    $total_pages = ceil($total_rows / $records_per_page);

    echo '<div class="container" style="text-align: center; margin-top: -30px; margin-bottom: 30px">';
      if ($total_pages > 1) {
          for ($i = 1; $i <= $total_pages; $i++) {
              // Check if there is a category set and append it to the link
              $link = 'packages.php?page=' . $i;
              if (isset($_GET['category'])) {
                  $link .= '&category=' . urlencode($_GET['category']);
              }

              echo "<a href='$link'";
              if ($page == $i) echo " class='btn btn-danger'";
              else echo " class='btn btn-default'";
              echo ">" . $i . "</a> ";
          }
      }
      echo '</div>';

            $stmt->free_result();
            $db->close();

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