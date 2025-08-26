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
    $fullName = $_POST["full-name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $mobileNumber = $_POST["mobile-number"];

    // Validate inputs
    if (empty($fullName) || empty($username) || empty($email) || empty($password) || empty($age) || empty($mobileNumber)) {
        echo "All fields are required.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    if (!is_numeric($age) || $age <= 0) {
        echo "Invalid age.";
        exit();
    }

    if (!preg_match("/^[0-9]{10,15}$/", $mobileNumber)) {
        echo "Invalid mobile number format.";
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO register (full_name, username, age, mobile_number,email, password) 
            VALUES ('$fullName', '$username', '$age', '$mobileNumber', '$email', '$password')";

    // Execute the query and handle potential errors
    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
