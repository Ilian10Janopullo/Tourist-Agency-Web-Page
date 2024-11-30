<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Travel Agency</title>
    <link rel="stylesheet" href="assets/stylesheets/general-styles.css" />
    <link rel="stylesheet" href="assets/stylesheets/hamburgers.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script src="assets/scripts/header.js" defer></script>
    <style>
      .add-package-section {
        padding: 7rem 0 6rem;
      }
      #add-package-form button[type="submit"] {
        margin-top: 2rem;
        cursor: pointer;
        font-size: 1.2rem;
        font-weight: 600;
        text-decoration: none;
        letter-spacing: 0.1px;
        background-color: #b01724;
        color: #fff;
        padding: 10px 22px;
        border-radius: 5px;
      }
    </style>
  </head>
  <body>

  <?php
    require_once("header.php");
    require_once("database.php");

    if(!isset($_SESSION['developer'])){
        $_SESSION['error'] = "You need to login as admin!";
        header("Location: login.php");
        exit();
    }

    $packageId = $_GET['id'];

    if(!isset($packageId)){
        header("Location: managePackages.php");
        exit();
    }

    $query = "SELECT * FROM packages WHERE id = $packageId";

        $stmt = $db -> prepare($query);
        $stmt ->execute();
        $stmt -> store_result();
        $stmt -> bind_result($id, $city, $description, $category, $imageLink, $kidsPrice, $adultPrice);
        $stmt -> fetch();

        $stmt ->free_result();
        $db -> close();


    ?>

    <section class="add-package-section">
      <div class="container mb-5 text-center">
        <h2 class="fs-2 fw-bold">Edit a Package</h2>
      </div>
      <div class="container">
        <form action="editPackageProcessing.php" id="add-package-form" method = "post">
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Tirana" required value= <?php echo $city; ?> />
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="City Description" required value="<?php echo htmlspecialchars($description); ?>" />
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
              <select class="form-control" id="category" name = "category" required>
                <option selected disabled value="">Choose...</option>
                <option value="sea" <?php if($category == "sea") echo "selected";?>>Sea</option>
                <option value="mountain" <?php if($category == "mountain") echo "selected";?>>Mountain</option>
                <option value="historical" <?php if($category == "historical") echo "selected";?>>Historical</option>
                <option value="urban" <?php if($category == "urban") echo "selected";?>>Urban</option>
              </select>
          </div>
          <div class="mb-3">
            <label for="image-link" class="form-label">Image Link</label>
            <input type="text" class="form-control" id="image-link" name="image-link" placeholder="https://www.image.com" required value = "<?php echo $imageLink;?>"/>
          </div>
          <div class="mb-3">
            <label for="kids-price" class="form-label">Kids Price</label>
            <input type="number" class="form-control" id="kids-price" name="kids-price"  min = "0" required value = "<?php echo $kidsPrice; ?>"/>
          </div>
          <div class="mb-3">
            <label for="adult-price" class="form-label">Adult Price</label>
            <input type="number" class="form-control" id="adult-price" name="adults-price"  min = "0" required value = "<?php echo $adultPrice; ?>"/>
          </div>
          <button type="submit" name="submit" id="submit" value= "<?php echo $packageId; ?>">Edit</button>
        </form>
      </div>
    </section>
    <?php
      require_once("footer.html");
    ?>
  </body>
</html>
