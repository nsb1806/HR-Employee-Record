<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "hr_employee_record";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
