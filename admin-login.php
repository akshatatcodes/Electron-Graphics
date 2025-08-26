<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session to store admin info upon login
session_start();

// Database credentials
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

// Handle form submission
if (isset($_POST["submit"])) {
    // Retrieve and sanitize form data
    $adminUsername = $conn->real_escape_string($_POST["admin-username"]);
    $adminPassword = $conn->real_escape_string($_POST["admin-password"]);

    // Validate inputs
    if (empty($adminUsername) || empty($adminPassword)) {
        echo "All fields are required.";
        exit();
    }

    // Check credentials in the database
    $sql = "SELECT * FROM admins WHERE username = '$adminUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch admin record
        $admin = $result->fetch_assoc();

        // Verify password (assuming passwords are hashed)
        if ($adminPassword === $admin['password']) { // Ideally use password_verify($adminPassword, $admin['password']) for hashed passwords
            // Correct credentials, start session and log access
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['admin_name'];

            // Log the access attempt (success)
            $admin_id = $_SESSION['admin_id'];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $status = 'success';

            $log_sql = "INSERT INTO access_logs (admin_id, ip_address, status, user_agent) 
                        VALUES ('$admin_id', '$ip_address', '$status', '$user_agent')";
            $conn->query($log_sql);

            // Redirect to admin dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password, log failed attempt
            logFailedAttempt($conn, $admin['id'], 'failed');
            header("Location: 404.html");
            exit();
        }
    } else {
        // Invalid username, log failed attempt
        logFailedAttempt($conn, null, 'failed'); // Pass null for admin_id if the admin does not exist
        header("Location: 404.html");
        exit();
    }
}

// Function to log failed attempts
function logFailedAttempt($conn, $admin_id, $status) {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Only log failed attempts if there is an admin_id
    if ($admin_id) {
        $log_sql = "INSERT INTO access_logs (admin_id, ip_address, status, user_agent) 
                    VALUES ('$admin_id', '$ip_address', '$status', '$user_agent')";
        $conn->query($log_sql);
    }
}

// Close connection
$conn->close();
?>
