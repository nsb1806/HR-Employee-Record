<?php
    require_once '../../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../index.php"); exit; }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $conn->prepare("UPDATE employees SET first_name=?, last_name=?, gender=?, birth_date=?, department=?, position=?, salary=?, email=?, contact_number=?, address=?, date_hired=? WHERE employee_id=?");
        $stmt->bind_param("sssssssssssi", 
            $_POST['firstname'], 
            $_POST['lastname'], 
            $_POST['gender'], 
            $_POST['dob'], 
            $_POST['department'], 
            $_POST['position'], 
            $_POST['salary'], 
            $_POST['email'], 
            $_POST['contact'], 
            $_POST['address'], 
            $_POST['date'], 
            $_POST['id']
        );
        
        $stmt->execute();
        header("Location: ../profile.php?id=" . $_POST['id'] . "&status=updated");
        exit;
    }
?>