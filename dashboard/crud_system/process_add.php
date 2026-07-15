<?php
    require_once '../../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../index.php"); exit; }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, gender, dob, department, POSITION, salary, email, contact_number, address, date_hired) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssissss", 
            $_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['dob'], 
            $_POST['department'], $_POST['position'], $_POST['salary'], $_POST['email'], 
            $_POST['contact'], $_POST['address'], $_POST['date']
        );
        $stmt->execute();
        header("Location: ../records.php?status=added");
        exit;
    }
?>