<?php
    require_once '../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../index.php"); exit; }

    if (isset($_GET['id'])) {
        $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        header("Location: ../records.php?status=deleted");
        exit;
    }
?>