<?php
    // $servername = "localhost";
    // $username = "mfu";
    // $password = "Mfuworkshop@2019";
    // $dbname = "mfuworkshop";
    $servername = "localhost";
    $username = "root";
    $password = "1150";
    $dbname = "mfuworkshop";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
?>