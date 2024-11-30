<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Travel Agency</title>
  <link rel="stylesheet" href="assets/stylesheets/general-styles.css">
  <link rel="stylesheet" href="assets/stylesheets/booking-styles.css">
  <link rel="stylesheet" href="assets/stylesheets/hamburgers.css">
  <style>
    .error {
      color: red;
      font-size: 0.8rem;
      height: 20px; /* Ensure the span does not change layout when error appears */
    }
  </style>

  <script src="assets/scripts/header.js" defer></script>
</head>
<body>

  <?php  

    require_once("header.php");
    require_once("database.php");

    if(!isset($_SESSION["developer"])){
      $_SESSION['error'] = "You need to log in as admin!";
      header("Location: login.php");
      exit();
    }

    $id = $_POST['reservationId'];

    if(!isset($id)){
        header("Location: manageReservations.php");
    }

    $query = "SELECT * FROM reservations WHERE id = $id";

    $stmt = $db -> prepare($query);
    $stmt ->execute();
    $stmt -> store_result();
    $stmt -> bind_result($id, $name, $surname, $adults, $kids, $fromDate, $toDate, $totalPrice, $place, $email);
    $stmt -> fetch();

    $stmt ->free_result();

    $query = "SELECT * FROM packages WHERE city = '$place'";

    $stmt = $db -> prepare($query);
    $stmt ->execute();
    $stmt -> store_result();
    $stmt -> bind_result($packageId, $city, $description, $category, $imageLink, $kidsPrice, $adultProce);
    $stmt -> fetch();

    $stmt ->free_result();
    $db -> close();

?>

    <section class="booking-section">
      <div class="container">
        <div class="booking-card">
          <div class="package-info-wrapper">
            <img src=<?php echo $imageLink;?> alt= <?php echo $city;?> class="booking-img" />
            <p class="package-heading"><?php echo $city;?></p>
            <p class="package-description">
            <?php echo $description;?>
            </p>
          </div>
          <div class="booking-info-wrapper">
            <p class="booking-heading">Book Package</p>
            <form action="editBookProcessing.php?id=<?php echo $id;?>" id="bookingForm" method = "post">
              <div class="input-wrapper">
                <label for="adults">Adults</label>
                <input type="number" id="adults" name="adults" required min="1" value = <?php echo $adults?> />
              </div>
              <div class="input-wrapper">
                <label for="kids">Kids</label>
                <input type="number" id="kids" name="kids" required min="0" value = <?php echo $kids?> />
              </div>
              <div class="input-wrapper">
                <label for="date-from">Date From</label>
                <input type="date" id="date-from" name="date-from" required value = <?php echo $fromDate?> />
              </div>
              <div class="input-wrapper">
                <label for="date-to">Date To</label>
                <input type="date" id="date-to" name="date-to" required value = <?php echo $toDate?> />
                <span class="error" id="error-date-to"></span>
              </div>
              <div class="input-wrapper">
              <button type="submit" name="submit" id = "submit" value="<?php echo $packageId;?>">Edit</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
    <?php
    require_once("footer.html");
  ?>
  
</body>
</html>