<?php
$current_page = basename($_SERVER['PHP_SELF']);
$sb_patient_name = $_SESSION['user_name'] ?? 'Patient';
$sb_patient_photo = !empty($_SESSION['user_photo']) ? "../uploads/".$_SESSION['user_photo'] : "https://ui-avatars.com/api/?name=".urlencode($sb_patient_name)."&background=3b82f6&color=fff";
?>
<!-- FIXED SIDEBAR -->
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

    <div class="user-card">
        <img src="<?php echo htmlspecialchars($sb_patient_photo); ?>" alt="avatar">
        <div>
            <div class="uname"><?php echo htmlspecialchars($sb_patient_name); ?></div>
            <div class="urole">Patient</div>
        </div>
    </div>

    <a href="dashboard.php"        class="nav-link <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>"><i class="fas fa-th-large"></i> Dashboard</a>
    <a href="book_appointment.php" class="nav-link <?php echo $current_page == 'book_appointment.php' ? 'active' : ''; ?>"><i class="far fa-calendar-plus"></i> Book Appointment</a>
    <a href="my_appointments.php"  class="nav-link <?php echo $current_page == 'my_appointments.php' ? 'active' : ''; ?>"><i class="far fa-calendar-alt"></i> My Appointments</a>
    <a href="chat.php"             class="nav-link <?php echo $current_page == 'chat.php' ? 'active' : ''; ?>"><i class="far fa-comment-dots"></i> Messages</a>
    <a href="medical_records.php"  class="nav-link <?php echo $current_page == 'medical_records.php' ? 'active' : ''; ?>"><i class="far fa-file-medical"></i> Medical Records</a>
    <a href="profile.php"          class="nav-link <?php echo $current_page == 'profile.php' ? 'active' : ''; ?>"><i class="far fa-user"></i> Profile</a>

    <div class="sidebar-spacer"></div>
    <a href="../login.php" class="nav-link logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</aside>
