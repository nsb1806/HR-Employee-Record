<?php 
    require_once '../db.php';
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    if (!isset($_SESSION['user_id'])) { header("Location: ../index.php"); exit; }

    $total_emp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM employees"))['count'];
    $total_dept = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT department) as count FROM employees WHERE department IS NOT NULL"))['count'];

    $dept_stats_query = "SELECT department, COUNT(*) as emp_count 
                         FROM employees 
                         GROUP BY department 
                         ORDER BY emp_count DESC";
    $dept_result = mysqli_query($conn, $dept_stats_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #dcdcdc; }
        .dept-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; }
        .dept-table th, .dept-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <main class="dashboard-main-content">
            <?php include('../includes/header.php'); ?>
            <div class="directory-container">
                <!-- Dashboard -->
                <h2>Workforce Overview</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <p style="color: #64748b; font-size: 12px; margin: 0;">Total Workforce</p>
                        <h3><?php echo $total_emp; ?></h3>
                    </div>
                    <div class="stat-card">
                        <p style="color: #64748b; font-size: 12px; margin: 0;">Total Departments</p>
                        <h3><?php echo $total_dept; ?></h3>
                    </div>
                    <div class="stat-card">
                        <p style="color: #64748b; font-size: 12px; margin: 0;">System Efficiency</p>
                        <h3>100%</h3>
                    </div>
                </div>
                <h3>Departmental Distribution</h3>
                <table class="dept-table">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Employee Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($dept_result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['department'] ?: 'Unassigned'); ?></td>
                            <td><strong><?php echo $row['emp_count']; ?></strong></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php include('../includes/footer.php'); ?>
        </main>
    </div>
</body>
</html>