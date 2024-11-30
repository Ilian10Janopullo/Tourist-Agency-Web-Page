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
          top: 30px; /* Adjust this value based on your header or desired distance from top */
          left: 50%; /* Center horizontally */
          transform: translateX(-50%); /* Center horizontally */
          z-index: 1000; /* Ensures the alert is above other elements */
      }

    </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php require_once("header.php"); 
        
        if(!isset($_SESSION['developer'])){
            $_SESSION['error'] = "You need to login as admin!";
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

            <h1 style="font-family: 'Times New Roman', Times, serif; text-align: center; margin-top: 50px;">Displayed Reservations</h1>
            <hr />

            <?php
            require_once("database.php");

            $records_per_page = 4;
            $page = 1;
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $page = $_GET['page'];
            }
            $offset = ($page - 1) * $records_per_page;

            $query = "SELECT * FROM reservations LIMIT $offset, $records_per_page";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $surname, $adults, $kids, $fromDate, $toDate, $totalPrice, $place, $email);

            if ($stmt->num_rows == 0) {
                echo '<div class="container" style="width: 18rem; align-items: center; margin-left: 420; margin-top: 90px; ; margin-bottom: 90px;">
                        <div class="card">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/007/104/553/small/search-no-result-not-found-concept-illustration-flat-design-eps10-modern-graphic-element-for-landing-page-empty-state-ui-infographic-icon-vector.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-heading">No reservation found!</p>
                            </div>
                        </div>
                    </div>';
                    require_once("footer.html");
                exit();
            }
            ?>

            <div class="container" style="align-items: center; font-family: 'Times New Roman', Times, serif; margin-top: 50px; margin-bottom: 90px;">
                <table class="table table-striped table-hover">
                <th>
                    <td>Name</td>
                    <td>Surname</td>
                    <td>Email</td>
                    <td>Adult Nr</td>
                    <td>Kids Nr</td>
                    <td>From Date</td>
                    <td>To Date</td>
                    <td>Place</td>
                    <td>Price</td>
                    <td></td>
                    <td></td>
                </th>

                <?php
                while ($stmt->fetch()) {
                    echo "<tr>
                    <td></td>
                    <td>$name</td>
                    <td>$surname</td>
                    <td>$email</td>
                    <td>$adults</td>
                    <td>$kids</td>
                    <td>$fromDate</td>
                    <td>$toDate</td>
                    <td>$place</td>
                    <td>$totalPrice</td>";
                    ?>
                    <form action="editReservations.php" method="post">
                    <td><button type="submit" name="reservationId" value="<?php echo $id;?>" class="btn btn-primary">Edit</button></td>
                    </form>

                    <form action="deleteReservations.php" method="post">
                    <td><button type="submit" name="reservationId" value="<?php echo $id;?>" class="btn btn-danger">Delete</button></td>
                    </form>
                    <?php
                    echo "</tr>";
                }
                ?>
                </table>
            </div>
            <?php
            
            $result = $db->query("SELECT COUNT(*) FROM reservations");
            $row = $result->fetch_row();
            $total_rows = $row[0];
            $total_pages = ceil($total_rows / $records_per_page);

            echo '<div class="container" style="text-align: center; margin-top: 20px;">';
            if ($total_pages > 1) {
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='manageReservations.php?page=" . $i . "'";
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
        <?php require_once("footer.html"); ?>
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
