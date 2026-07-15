<?php
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    if (!isset($_SESSION['user_id'])) { exit('Unauthorized'); }

    $current_page = basename($_SERVER['PHP_SELF']);
    $in_crud = basename(dirname($_SERVER['PHP_SELF'])) == 'crud_system';
    $dashboard_path = $in_crud ? '../' : '';
    $crud_path = $in_crud ? '' : 'crud_system/';
    $auth_path = $in_crud ? '../../authentication/' : '../authentication/';
?>

<aside class="sidebar">
    <div class="sidebar-brand">
        <h2 style = "color: #78a6b9;"> EmployEase</h2>
    </div>

    <nav class="sidebar-menu">
        <ul>
            <!-- Dashboard Home -->
            <li>
                <a href="<?php echo $dashboard_path; ?>index.php"
                class="menu-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                    <span class="menu-icon"></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <!-- Employee Records -->
            <li>
                <a href="<?php echo $dashboard_path; ?>records.php"
                class="menu-item <?php echo ($current_page == 'records.php') ? 'active' : ''; ?>">
                    <span class="menu-icon"></span>
                    <span class="menu-text">Employee Records</span>
                </a>
            </li>
            <!-- Reports -->
            <li>
                <a href="<?php echo $dashboard_path; ?>reports.php" class="menu-item <?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>">
                    <span class="menu-icon"></span>
                    <span class="menu-text">Workforce Reports</span>
                </a>
            </li>
            <!-- Add Employee -->
            <li>
                <a href="<?php echo $crud_path; ?>createEmployee.php" class="menu-item <?php echo ($current_page == 'createEmployee.php') ? 'active' : ''; ?>">
                    <span class="menu-icon"></span>
                    <span class="menu-text">Add Employee</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="<?php echo $auth_path; ?>logout.php" class="sidebar-logout">
            <span class="menu-icon"></span>
            <span class="menu-text">Logout</span>
        </a>
    </div>
</aside>
