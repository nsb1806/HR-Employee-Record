<?php
    require_once '../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../index.php"); exit; }

    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $employee = $stmt->get_result()->fetch_assoc();

    if (!$employee) { exit("Employee not found."); }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <?php include('../includes/sidebar.php'); ?>
        <main class="dashboard-main-content">
            <?php include('../includes/header.php'); ?>

            <div class="directory-container">
                <a href="records.php" style="text-decoration: none; color: #1f4959; font-weight: bold;">← Back to Records</a>

                <div class="profile-card" style="background: white; padding: 30px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: baseline;">
                        <h2 style="margin: 0; color: #1f4959;">
                            <?php echo htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']); ?>
                        </h2>
                        <span style="color: #7f8c8d; font-size: 0.95rem; font-weight: bold;">
                            Employee ID: <?php echo htmlspecialchars($employee['employee_id']); ?>
                        </span>
                    </div>
                    <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0 25px 0;">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                        <p style="margin: 0;"><strong>Gender:</strong> <?php echo htmlspecialchars($employee['gender'] ?: 'N/A'); ?></p>
                        <p style="margin: 0;"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($employee['birth_date'] ?: 'N/A'); ?></p>

                        <p style="margin: 0;"><strong>Department:</strong> <?php echo htmlspecialchars($employee['department'] ?: 'N/A'); ?></p>
                        <p style="margin: 0;"><strong>Position:</strong> <?php echo htmlspecialchars($employee['position'] ?: 'N/A'); ?></p>

                        <p style="margin: 0;"><strong>Email:</strong> <?php echo htmlspecialchars($employee['email'] ?: 'N/A'); ?></p>
                        <p style="margin: 0;"><strong>Phone:</strong> <?php echo htmlspecialchars($employee['contact_number'] ?: 'N/A'); ?></p>

                        <p style="margin: 0;"><strong>Date Hired:</strong> <?php echo htmlspecialchars($employee['date_hired'] ?: 'N/A'); ?></p>
                        <p style="margin: 0;"><strong>Salary:</strong> PHP <?php echo number_format($employee['salary'] ?? 0, 2); ?></p>

                        <p style="margin: 0; grid-column: span 2;"><strong>Address:</strong> <?php echo htmlspecialchars($employee['address'] ?: 'N/A'); ?></p>

                    </div>

                    <div class="profile-actions" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                        <a href="crud_system/updateEmployee.php?id=<?php echo $employee['employee_id']; ?>"
                           class="btn-edit" style="padding: 10px 20px; background: #1f4959; color: white; text-decoration: none; border-radius: 4px; display: inline-block;">Edit Profile</a>

                        <a href="crud_system/deleteEmployee.php?id=<?php echo $employee['employee_id']; ?>"
                           class="btn-delete" style="padding: 10px 20px; background: #e74c3c; color: white; text-decoration: none; border-radius: 4px; margin-left: 10px; display: inline-block;"
                           onclick="return confirm('WARNING: This will permanently delete this employee. Continue?');">Delete Employee</a>
                    </div>
                </div>
            </div>
            <?php include('../includes/footer.php'); ?>
        </main>
    </div>
</body>
</html>
