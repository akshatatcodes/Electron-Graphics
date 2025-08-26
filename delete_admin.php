<?php
$id = $_GET['id']; // Get admin ID from URL

$conn = new mysqli("localhost", "root", "", "registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete admin
$sql = "DELETE FROM admins WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Admin deleted successfully";
} else {
    echo "Error deleting admin: " . $conn->error;
}

$conn->close();

// Redirect back to admin list after deletion
header("Location: admin_management.php");
exit;
?>
