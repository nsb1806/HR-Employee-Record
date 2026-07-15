<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "hr_employee_record";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = mysqli_connect($servername, $username, $password, $database);
        mysqli_set_charset($conn, "utf8mb4");
    } catch (mysqli_sql_exception $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>
