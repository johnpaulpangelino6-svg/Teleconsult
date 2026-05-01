<?php
$current_page = basename($_SERVER['PHP_SELF']);
$sb_admin_name = $_SESSION['user_name'] ?? 'Admin';
$sb_admin_photo = !empty($_SESSION['user_photo']) ? "../uploads/".$_SESSION['user_photo'] : "https://ui-avatars.com/api/?name=".urlencode($sb_admin_name)."&background=020617&color=fff";
?>
<aside class="sidebar">
    <div class="logo">
        <div class="logo-img">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#3b82f6"/>
                <path d="M12 18l-1.45-1.32C5.4 12.36 2 9.28 2 5.5 2 2.42 4.42 0 7.5 0c1.74 0 3.41.81 4.5 2.09C13.09 0.81 14.76 0 16.5 0 19.58 0 22 2.42 22 5.5c0 3.78-3.4 6.86-8.55 11.54L12 18z" fill="#06b6d4" opacity="0.3"/>
                <path d="M10 8h4M12 6v4" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="logo-text">
            <b>Community Teleconsult</b>
            <span>Online Medical Consultation System for Local Communities</span>
        </div>
    </div>

    <div class="nav-section">
        <a href="dashboard.php" class="nav-link <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="manage_users.php" class="nav-link <?php echo $current_page == 'manage_users.php' ? 'active' : ''; ?>">
            <i class="fas fa-users-cog"></i> Manage Users
        </a>
        <a href="appointments.php" class="nav-link <?php echo $current_page == 'appointments.php' ? 'active' : ''; ?>">
            <i class="far fa-calendar-check"></i> Appointments
        </a>
        <a href="reports.php" class="nav-link <?php echo $current_page == 'reports.php' ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i> Reports
        </a>
        <a href="profile.php" class="nav-link <?php echo $current_page == 'profile.php' ? 'active' : ''; ?>">
            <i class="far fa-user"></i> Profile
        </a>
    </div>

    <div class="sidebar-spacer"></div>
    
    <div class="user-card">
        <img src="<?php echo htmlspecialchars($sb_admin_photo); ?>" alt="avatar">
        <div>
            <div class="uname"><?php echo htmlspecialchars($sb_admin_name); ?></div>
            <div class="urole">Administrator</div>
        </div>
    </div>

    <a href="../login.php" class="nav-link logout">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</aside>
