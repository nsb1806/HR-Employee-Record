<?php
    require_once '../../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../../index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <?php include('../../includes/sidebar.php'); ?>
        <main class="dashboard-main-content">
            <?php include('../../includes/header.php'); ?>

            <div class="directory-container">
                <h2>Register New Employee</h2><br><br>
                <form action="process_add.php" method="POST" class="styled-form">
                <div class="form-grid">
                    <div>
                        <label>First Name</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                    <div>
                        <label>Gender</label>
                        <input type="text" id="gender" name="gender">
                    </div>
                    <div>
                        <label>Date of Birth</label>
                        <input type="date" id="birth_date" name="birth_date">
                    </div>
                    <div>
                        <label>Department</label>
                        <input type="text" id="department" name="department">
                    </div>
                    <div>
                        <label>Position</label>
                        <input type="text" id="position" name="position">
                    </div>
                    <div>
                        <label>Salary</label>
                        <input type="number" step="0.01" id="salary" name="salary">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div>
                        <label>Contact Number</label>
                        <input type="text" id="contact" name="contact">
                    </div>
                    <div>
                        <label>Address</label>
                        <input type="text" id="address" name="address">
                    </div>
                    <div>
                        <label>Date Hired</label>
                        <input type="date" id="date" name="date">
                    </div>
                </div>
                <button type="submit" class="add-emp-btn form-submit-btn">Add Record</button>
            </form>
            </div>
            <?php include('../../includes/footer.php'); ?>
        </main>
    </div>
</body>
</html>

