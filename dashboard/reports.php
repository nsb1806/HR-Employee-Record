<?php
    require_once '../db.php';
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    if (!isset($_SESSION['user_id'])) { header("Location: ../index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workforce Reports</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <?php include('../includes/sidebar.php'); ?>

        <main class="dashboard-main-content">
            <?php include('../includes/header.php'); ?>

            <div class="directory-container">
                <h2>Workforce Analytics & Reports</h2>
                <p>This section is used to generate reports on employee distribution, turnover rates, and predictive risk assessments.</p>
                <p style="color: #7f8c8d; font-style: italic;">Data is currently unavailable.</p>
            </div>

            <?php include('../includes/footer.php'); ?>
        </main>
    </div>
</body>
</html>
