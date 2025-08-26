<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST["submit"])) {
    // Retrieve and sanitize form data
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    // Validate inputs
    if (empty($inputUsername) || empty($inputPassword)) {
        echo "Username and password are required.";
        exit();
    }

    // Check user credentials
    $sql = "SELECT * FROM register WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $inputUsername, $inputPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Redirect to home page
        header("Location: index.html");
        exit();
    } else {
        // Redirect to page not found
        header("Location: 404.html");
        exit();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
