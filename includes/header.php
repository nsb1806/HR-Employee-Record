<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    exit('Unauthorized');
}
?>
<header class="dashboard-header">
    <div class="header-title">
        <br><br>
        <h1>HR Management System</h1>
    </div>
    
    <div class="header-profile">
        <div class="profile-divider"></div>
        <div class="profile-info">
            <span class="profile-name">Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
            <span class="profile-role">HR Administrator</span>
        </div>
        <div class="header-avatar">
            <?php 
                $user_initial = strtoupper(substr($_SESSION['username'], 0, 1));
            ?>
            <div class="avatar-badge"><?php echo $user_initial; ?></div>
        </div>
    </div>
</header>