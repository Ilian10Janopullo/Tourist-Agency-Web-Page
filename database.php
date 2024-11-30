<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "travelAgency";

    @$db = new mysqli($host, $username, $password, $databaseName);

    if(mysqli_connect_errno()){
        echo "Cpnnetion to database failed!";
        exit;
    }
?>