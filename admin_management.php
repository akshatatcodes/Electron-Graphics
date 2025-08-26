<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM admins WHERE id=$delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Admin deleted successfully";
    } else {
        echo "Error deleting admin: " . $conn->error;
    }
}

// Handle adding a new admin if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $admin_name = $_POST['admin_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $add_sql = "INSERT INTO admins (admin_name, username, email, password) 
                VALUES ('$admin_name', '$username', '$email', '$password')";
    
    if ($conn->query($add_sql) === TRUE) {
        echo "New admin added successfully";
    } else {
        echo "Error adding admin: " . $conn->error;
    }
}

// Fetch all admins for display
$sql = "SELECT * FROM admins";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/admin_management.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Additional Styles -->
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
                <li class="nav-item nav-item-hover"><a class="nav-link" href="access_logs.php">Access Logs</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="media_library.php">Media Library</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="logout.php">Logout</a></li>
                <li class="nav-item">
                    <input type="checkbox" id="dark_toggler" class="dark_toggler" aria-label="Toggle Light Mode" onclick="toggle_light_mode()" checked>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="title-section" style="margin-top: 80px;"> <!-- Adjust margin to accommodate fixed navbar -->
        <h1 >Admin Management</h1>
    </div>

<!-- Add New Admin Form -->
<h3 align="center">Add New Admin</h3>
<form method="POST" action="">
    <label>Admin Name:</label>
    <input type="text" name="admin_name" required><br>
    
    <label>Username:</label>
    <input type="text" name="username" required><br>
    
    <label>Email:</label>
    <input type="email" name="email" required><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br>
    
    <input type="submit" name="add_admin" value="Add Admin">
    <div class="f1"></div>
</form>

<!-- Display Admin List -->
<h3>Admin List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Admin Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['admin_name'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>
                        <a href='edit_admin.php?id=" . $row['id'] . "'>Edit</a> |
                        <a href='admin_management.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this admin?\")'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No admins found</td></tr>";
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
