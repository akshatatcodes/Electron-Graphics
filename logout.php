<?php
session_start();

// Include your database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get admin ID from session
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Update logout time in access_logs
    $log_sql = "UPDATE access_logs SET logout_time = CURRENT_TIMESTAMP WHERE admin_id = '$admin_id' AND logout_time IS NULL";
    $conn->query($log_sql);

    // Unset all session variables and destroy the session
    session_unset();
    session_destroy();
}

// Redirect to the login page
header("Location: admin.html");
exit();
?>
