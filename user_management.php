<?php
// Database connection
include 'db.php'; // Make sure to include the file that contains your database connection

// Fetch users from the database
$query = "SELECT * FROM register"; // Assuming 'register' is your table name
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query Failed: " . mysqli_error($conn)); // Error handling for query failure
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/user_management.css">
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
                <li class="nav-item nav-item-hover"><a class="nav-link" href="message.php">Messages/Feedback</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="admin_management.php">Admin Profile Settings</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="access_logs.php">Access Logs</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="media_library.php">Media Library</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="logout.php">Logout</a></li>
                <li class="nav-item">
                    <input type="checkbox" id="dark_toggler" class="dark_toggler" aria-label="Toggle Light Mode" onclick="toggle_light_mode()" checked>
                </li>
            </ul>
        </div>
    </nav>

    <div class="title-section" style="margin-top: 80px;">
        <h1>User Management</h1>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Age</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Password</th> <!-- Display password -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['age']; ?></td>
                    <td><?php echo $user['mobile_number']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['password']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Electron Graphics. All rights reserved.</p>
    </footer>
</body>

</html>
