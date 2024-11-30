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
      .edit-user-section {
        padding: 7rem 0 6rem;
      }
      #edit-users-form button[type="submit"] {
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

    $userId = $_POST['id'];

    $query = "SELECT * FROM users WHERE id = $userId";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $surname, $email, $password, $status);
            $stmt->fetch();

    ?>

    <section class="edit-user-section">
      <div class="container mb-5 text-center">
        <h2 class="fs-2 fw-bold">Edit a User</h2>
      </div>
      <div class="container">
        <form action="editUsersProcessing.php" id="edit-users-form" method = "post">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="John" value="<?php echo $name;?>" required />
          </div>
          <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Doe" required value="<?php echo $surname;?>"/>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="johndoe@mail.com" required value="<?php echo $email;?>"/>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" minlength="8" autocomplete="off"/>
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Permissions</label>
              <select class="form-control" id="category" name = "status" required>
                <option selected disabled value="">Choose...</option>
                <option value="0" <?php if($status == 0) echo "selected"?>>Client</option>
                <option value="1" <?php if($status == 1) echo "selected"?>>Admin</option>
              </select>
          </div>
          <button type="submit" name="submit" id="submit" value= "<?php echo $userId; ?>">Edit</button>
        </form>
      </div>
    </section>
    <?php
      require_once("footer.html");
    ?>
  </body>
</html>
