<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli("localhost", "root", "", "registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create access_logs table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS access_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    logout_time TIMESTAMP NULL,
    ip_address VARCHAR(50),
    status VARCHAR(20),  -- 'success' or 'failed'
    user_agent TEXT,
    FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    // Table created successfully
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Fetch logs from the access_logs table
$sql = "SELECT a.admin_name, l.login_time, l.logout_time, 
               l.ip_address, l.status, l.user_agent 
        FROM access_logs l 
        JOIN admins a ON l.admin_id = a.id 
        ORDER BY l.login_time DESC";
$result = $conn->query($sql);

// Fetch users from the database
$query = "SELECT * FROM register"; // Assuming 'register' is your table name
$result_users = mysqli_query($conn, $query);

// Check if the query was successful for users
if (!$result_users) {
    die("Query Failed: " . mysqli_error($conn)); // Error handling for query failure
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/access_log.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        function toggle_light_mode() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
        }
    </script>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top dark-theme" id="navbar">
        <a class="navbar-brand" href="dashboard.php">Electron Graphics</a>
        <div class="hamburger_wrapper navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div id="js-hamburger" class="hamburger">
                <span class="first"></span>
                <span class="second"></span>
                <span class="third"></span>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" id="navbar-content">
                <li class="nav-item nav-item-hover"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="user_management.php">User Management</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="message.php">Messages/Feedback</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="admin_management.php">Admin Profile Settings</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="media_library.php">Media Library</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="logout.php">Logout</a></li>
                <li class="nav-item">
                    <input type="checkbox" id="dark_toggler" class="dark_toggler" aria-label="Toggle Light Mode" onclick="toggle_light_mode()" checked>
                </li>
            </ul>
        </div>
    </nav>

    <div class="title-section" style="margin-top: 80px;">
        <h1>Access logs</h1>
    </div>

    <table border="1">
        <tr>
            <th>Admin Name</th>
            <th>Login Time</th>
            <th>Logout Time</th>
            <th>IP Address</th>
            <th>Status</th>
            <th>User Agent</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['admin_name']) . "</td>
                        <td>" . htmlspecialchars($row['login_time']) . "</td>
                        <td>" . ($row['logout_time'] ? htmlspecialchars($row['logout_time']) : 'N/A') . "</td>
                        <td>" . (isset($row['ip_address']) ? htmlspecialchars($row['ip_address']) : 'N/A') . "</td>
                        <td>" . (isset($row['status']) ? htmlspecialchars($row['status']) : 'N/A') . "</td>
                        <td>" . (isset($row['user_agent']) ? htmlspecialchars($row['user_agent']) : 'N/A') . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No access logs found</td></tr>";
        }
        ?>

    </table>
    <footer>
        <p>&copy; <?php echo date(format: "Y"); ?> Electron Graphics. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>