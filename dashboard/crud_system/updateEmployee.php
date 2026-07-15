<?php
    require_once '../../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../../index.php"); exit; }

    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if (!$row) { exit("Employee not found."); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <?php include('../../includes/sidebar.php'); ?>
        <main class="dashboard-main-content">
            <?php include('../../includes/header.php'); ?>
            <div class="directory-container">
                <h2>Edit Employee: <?php echo htmlspecialchars($row['first_name']); ?></h2>
                <form action="process_update.php" method="POST" class="styled-form">
                    <input type="hidden" name="id" value="<?php echo $row['employee_id']; ?>">
                    <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label>First Name</label>
                            <input type="text" name="firstname" value="<?php echo htmlspecialchars($row['first_name']); ?>" required style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Last Name</label>
                            <input type="text" name="lastname" value="<?php echo htmlspecialchars($row['last_name']); ?>" required style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Gender</label>
                            <input type="text" name="gender" value="<?php echo htmlspecialchars($row['gender']); ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Date of Birth</label>
                            <input type="date" name="birth_date" value="<?php echo htmlspecialchars($row['birth_date'] ?? ''); ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Department</label>
                            <input type="text" name="department" value="<?php echo htmlspecialchars($row['department']); ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Position</label>
                            <input type="text" name="position" value="<?php echo htmlspecialchars($row['position'] ?? $row['POSITION'] ?? ''); ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Salary</label>
                            <input type="number" step="0.01" name="salary" value="<?php echo $row['salary']; ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Contact Number</label>
                            <input type="text" name="contact" value="<?php echo htmlspecialchars($row['contact_number']); ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Address</label>
                            <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" style="width: 100%;"> <br><br>
                        </div>
                        <div>
                            <label>Date Hired</label>
                            <input type="date" name="date" value="<?php echo $row['date_hired']; ?>" style="width: 100%;"> <br><br>
                        </div>

                    </div>
                    <button type="submit" class="add-emp-btn" style="margin-top:20px; padding: 10px 20px;">Update Record</button>
                </form>
            </div>
            <?php include('../../includes/footer.php'); ?>
        </main>
    </div>
</body>
</html>
