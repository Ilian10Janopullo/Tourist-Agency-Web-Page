<html>
    <head>
        <title>Web Travel Agency</title>
        <link rel="stylesheet" href="assets/stylesheets/general-styles.css" />
        <link rel="stylesheet" href="assets/stylesheets/hamburgers.css" />
        <style>
      .alert {
          padding: 10px;
          border-radius: 5px;
          text-align: center;
          width: 490px; /* Adjust width considering padding and margin */
          box-sizing: border-box;
          opacity: 1;
          transition: opacity 0.5s ease-out;
          top: 10px; /* Adjust this value based on your header or desired distance from top */
          left: 50%; /* Center horizontally */
          transform: translateX(-50%); /* Center horizontally */
          z-index: 1000; /* Ensures the alert is above other elements */
      }

    </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <?php require_once("header.php"); 
            if(!isset($_SESSION['developer'])){
                $_SESSION['error'] = "You need to log in as an admin!";
                header("Location: login.php");
                exit();
            }
        ?>
        <div class="container" style="align-items: center; font-family: 'Times New Roman', Times, serif; text-align: center; margin-top: 20px; margin-bottom: 70px;">
            <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger" role="alert" id="alertMessage">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                
                if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert" id="alertMessage">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>
            <h1>Displayed Data</h1>
            <hr />

            <?php
            require_once("database.php");

            // Pagination Code
            $records_per_page = 4;
            $page = 1;
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $page = $_GET['page'];
            }
            $offset = ($page - 1) * $records_per_page;

            $query = "SELECT * FROM users LIMIT $offset, $records_per_page";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $surname, $email, $password, $status);

            if ($stmt->num_rows == 0) {
                echo '<div class="container" style="width: 18rem; align-items: center; margin-left: 420; margin-top: 90px; ; margin-bottom: 90px;">
                        <div class="card">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/007/104/553/small/search-no-result-not-found-concept-illustration-flat-design-eps10-modern-graphic-element-for-landing-page-empty-state-ui-infographic-icon-vector.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-heading">No users found!</p>
                            </div>
                        </div>
                    </div>';
                    require_once("footer.html");
                exit();
            }

            // Display Data
            echo '<div class="container" style="align-items: center; font-family: Times New Roman, Times, serif; margin-top: 50px;">
                    <table class="table table-striped table-hover">
                        <th><td>ID</td><td>Name</td><td>Surname</td><td>Email</td><td>Status</td><td></td><td></td></th>';

            while ($stmt->fetch()) {

                if($status == 0){
                    $status = "Client";
                } else if($status == 1){
                    $status = "Admin";
                }

                echo "<tr>
                        <td></td>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$surname</td>
                        <td>$email</td>
                        <td>$status</td>
                        <td><form action='editUsers.php' method='post'><button type='submit' name='id' value='$id' class='btn btn-primary'>Edit</button></form></td>
                        <td><form action='deleteUsers.php' method='post'><button type='submit' name='id' value='$id' class='btn btn-danger'>Delete</button></form></td>
                      </tr>";
            }
            echo '</table></div>';

            // Free Result and Close DB

            // Pagination Links
            $result = $db->query("SELECT COUNT(*) FROM users");
            $row = $result->fetch_row();
            $total_rows = $row[0];
            $total_pages = ceil($total_rows / $records_per_page);

            echo '<div class="container" style="text-align: center; margin-top: 20px;">';
            if ($total_pages > 1) {
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='manageUsers.php?page=" . $i . "'";
                    if ($page == $i) echo " class='btn btn-danger'";
                    else echo " class='btn btn-default'";
                    echo ">" . $i . "</a> ";
                }
            }
            echo '</div>';
            $stmt->free_result();
            $db->close();
            ?>
        </div>
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
