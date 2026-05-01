<?php
session_start();
include 'config.php';

if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['patient_id'];

/* =========================
   FETCH USER DATA (FIXED)
========================= */
$result = $conn->query("SELECT * FROM users WHERE id='$id'");

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $user = null;
}

/* =========================
   UPDATE PROFILE
========================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];

    // IMAGE UPLOAD
    if (!empty($_FILES['photo']['name'])) {

        $targetDir = "uploads/";

        // create folder if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetFile = $targetDir . $fileName;

        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

        $conn->query("UPDATE users SET photo='$fileName' WHERE id='$id'");
    }

    // UPDATE NAME & EMAIL
    $conn->query("UPDATE users SET name='$name', email='$email' WHERE id='$id'");

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>

<link rel="stylesheet" href="assets/css/profile.css">

</head>
<body>

<div class="container">

    <h2>👤 My Profile</h2>

    <!-- SHOW ERROR IF USER NOT FOUND -->
    <?php if (!$user) { ?>
        <div class="error">User not found. Please login again.</div>
    <?php } ?>

    <!-- PROFILE IMAGE (FIXED) -->
    <?php if ($user && !empty($user['photo'])) { ?>
        <img src="uploads/<?php echo $user['photo']; ?>">
    <?php } else { ?>
        <img src="https://via.placeholder.com/120">
    <?php } ?>

    <!-- FORM -->
    <form method="POST" enctype="multipart/form-data">

        <input type="file" name="photo">

        <input type="text" name="name"
        value="<?php echo $user ? $user['name'] : ''; ?>"
        placeholder="Enter your name" required>

        <input type="email" name="email"
        value="<?php echo $user ? $user['email'] : ''; ?>"
        placeholder="Enter your email" required>

        <button type="submit">Update Profile</button>
    </form>

    <div class="back">
        <a href="user_dashboard.php">⬅ Back to Dashboard</a>
    </div>

</div>

</body>
</html>