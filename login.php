<?php
ob_start(); // IMPORTANT: prevents header errors
session_start();
include 'config.php';

$error = "";
$success = "";

// Show success message (from register)
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

// LOGIN PROCESS
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepare query
    $stmt = $conn->prepare("SELECT id, name, password, role, photo FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // VERIFY PASSWORD
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_photo'] = $user['photo'];

            // REDIRECT BASED ON ROLE
            if ($user['role'] === "patient") {
                header("Location: patient/dashboard.php");
                exit();
            } 
            elseif ($user['role'] === "doctor") {
                header("Location: doctor/dashboard.php");
                exit();
            } 
            elseif ($user['role'] === "admin") {
                header("Location: admin/dashboard.php");
                exit();
            } 
            else {
                $error = "User role not defined!";
            }

        } else {
            $error = "Invalid email or password!";
        }

    } else {
        $error = "Invalid email or password!";
    }
}

ob_end_flush(); // flush output
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

<div class="container">

<div class="logo">
    <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#3b82f6"/>
            <path d="M12 18l-1.45-1.32C5.4 12.36 2 9.28 2 5.5 2 2.42 4.42 0 7.5 0c1.74 0 3.41.81 4.5 2.09C13.09 0.81 14.76 0 16.5 0 19.58 0 22 2.42 22 5.5c0 3.78-3.4 6.86-8.55 11.54L12 18z" fill="#06b6d4" opacity="0.3"/>
            <path d="M10 8h4M12 6v4" stroke="white" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
</div>

<h2>Community Teleconsult</h2>
<p class="subtitle">Online Medical Consultation System for Local Communities</p>

<?php if ($success) echo "<p class='success'>$success</p>"; ?>
<?php if ($error) echo "<p class='error'>$error</p>"; ?>

<form method="POST">

<div class="input-group">
    <label>Email Address</label>
    <input type="email" name="email" placeholder="you@example.com" required>
</div>

<div class="input-group">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter password" required>
</div>

<button type="submit">Sign In</button>

</form>

<div class="register">
Don't have an account? <a href="register.php">Register here</a>
</div>

</div>

</body>
</html>