<?php 
    require_once '../db.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit;
    }

    // --- 1. SEARCH & FILTER---
    $query = "SELECT * FROM employees WHERE 1=1";
    $params = [];
    $types = "";

    // Search by Name Filter
    if (!empty($_GET['search'])) {
        $searchTerm = "%" . $_GET['search'] . "%";
        $query .= " AND (first_name LIKE ? OR last_name LIKE ?)";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= "ss";
    }

    // Department Filter
    if (!empty($_GET['department'])) {
        $query .= " AND department = ?";
        $params[] = $_GET['department'];
        $types .= "s";
    }

    // Order Query Results
    $query .= " ORDER BY last_name ASC, first_name ASC";

    // Prepare & Execute
    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $emp_result = $stmt->get_result();

    // The counter reflects how many employees match the current filter
    $total_employees = $emp_result->num_rows;
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Employees Directory</title>
        <link rel="stylesheet" href="../assets/style.css">
    </head>
    <body>
        <!-- 1. THE MAIN WRAPPER -->
        <div class="dashboard-wrapper">
            <!-- 2. INCLUDE SIDEBAR -->
            <?php include('../includes/sidebar.php'); ?>
            <!-- 3. THE MAIN CONTENT AREA -->
            <main class="dashboard-main-content">
                <!-- 4. INCLUDE HEADER -->
                <?php include('../includes/header.php'); ?>
                <!-- 5. DIRECTORY CONTAINER  -->
                <div class="directory-container">
                    <!-- TOP APPLICATION BAR -->
                    <div class="top-nav-bar">
                        <div class="directory-title">
                            <h2>Employees <span class="badge"><?php echo $total_employees; ?></span></h2>
                        </div>
                        <div class="top-actions">
                            <span class="nav-tab active">DIRECTORY</span>
                            <a href="crud_system/createEmployee.php" class="add-emp-btn">+ ADD EMPLOYEE</a>
                        </div>
                    </div>

                    <!-- FILTER / SEARCH UTILITY WRAPPER -->
                    <form method="GET" action="" class="filter-wrapper" style="display: flex; gap: 20px; align-items: flex-end; background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #e0e0e0; margin-bottom: 20px;">
                        
                        <!-- Search Field -->
                        <div style="flex: 3; min-width: 250px;">
                            <input type="text" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" placeholder="🔍 Search by Name..." style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 0.95rem;">
                        </div>
                        
                        <!-- Filter Dropdowns -->
                        <div class="filter-dropdowns" style="display: flex; gap: 15px; flex: 1.2;">
                            
                            <!-- Department Filter -->
                            <div class="filter-item" style="flex: 1;">
                                <small style="display: block; font-weight: bold; color: #7f8c8d; margin-bottom: 4px;">DEPARTMENT</small>
                                <select name="department" onchange="this.form.submit()" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background: #fff;">
                                    <option value="">View All</option>
                                    <?php 
                                    $dept_query = "SELECT DISTINCT department FROM employees WHERE department IS NOT NULL AND department != ''";
                                    $dept_res = mysqli_query($conn, $dept_query);
                                    while ($dept_row = mysqli_fetch_assoc($dept_res)) {
                                        $dept_val = htmlspecialchars($dept_row['department']);
                                        $selected = (isset($_GET['department']) && $_GET['department'] == $dept_val) ? 'selected' : '';
                                        echo "<option value='$dept_val' $selected>$dept_val</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons (Submit & Reset) -->
                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="add-emp-btn" style="padding: 10px 15px; margin: 0; background: #2c3e50; border: none; cursor: pointer;">Search</button>
                            <?php if (!empty($_GET['search']) || !empty($_GET['department']) || !empty($_GET['gender'])): ?>
                                <a href="records.php" style="padding: 10px 15px; background: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 0.85rem;">Clear</a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <!-- MAIN DIRECTORY TABLE LIST -->
                    <div class="directory-table-container">
                        <table class="directory-table">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">NAME</th>
                                    <th style="width: 25%;">DEPARTMENT & LOCATION</th>
                                    <th style="width: 25%;">EMAIL ADDRESS</th>
                                    <th style="width: 15%;">WORK PHONE</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if ($emp_result && mysqli_num_rows($emp_result) > 0) {
                                    while ($row = mysqli_fetch_assoc($emp_result)) {
                                        $first_name = htmlspecialchars($row['first_name'] ?? '');
                                        $last_name = htmlspecialchars($row['last_name'] ?? '');
                                        $position = htmlspecialchars($row['position'] ?? 'Staff Member'); 
                                        $department = htmlspecialchars($row['department'] ?? 'Unassigned');
                                        $email = htmlspecialchars($row['email'] ?? 'n/a');
                                        $phone = htmlspecialchars($row['contact_number'] ?? 'n/a'); 
                                        
                                        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="employee-profile-cell">
                                                    <div class="avatar-circle"><?php echo $initials; ?></div>
                                                    <div class="name-meta">
                                                        <a href="profile.php?id=<?php echo $row['employee_id']; ?>" style="text-decoration:none; color:inherit;">
                                                            <strong><?php echo "$last_name, $first_name"; ?></strong>
                                                        </a>
                                                        <span class="subtitle-text"><?php echo $position; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dept-meta">
                                                    <span><?php echo $department; ?></span>
                                                    <span class="subtitle-text">Main Office</span>
                                                </div>
                                            </td>
                                            <td><span class="email-link"><?php echo $email; ?></span></td>
                                            <td><span class="phone-text"><?php echo $phone; ?></span></td>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' style='text-align:center; padding: 30px;'>No employees found matching the filters.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <!-- 6. INCLUDE FOOTER -->
            <?php include('../includes/footer.php'); ?>
        </div>
    </body>
</html>