<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/dashboard.css">
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
                <li class="nav-item nav-item-hover"><a class="nav-link" href="user_management.php">User Management</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="message.php">Messages/Feedback</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="admin_management.php">Admin Profile Settings</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="access_logs.php">Access Logs</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="media_library.php">Media Library</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="logout.php">Logout</a></li> <!-- Logout option -->
                <li class="nav-item">
                    <input type="checkbox" id="dark_toggler" class="dark_toggler" aria-label="Toggle Light Mode" onclick="toggle_light_mode()" checked>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="title-section" style="margin-top: 80px;"> <!-- Adjust margin to accommodate fixed navbar -->
        <h1>Welcome to the Admin Dashboard</h1>
    </div>

    <main>
        <section class="slider">
            <div class="slide"><img src="assets/images/admin.jpg" alt="Slide 1"></div>
            <div class="slide"><img src="assets/images/admin2.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="assets/images/admin3.jpg" alt="Slide 3"></div>
        </section>

        <section class="info-section">
            <h2>Admin Dashboard Overview</h2>
            <p>This dashboard provides a comprehensive overview of the administration functionalities of the site. You can manage users, view messages, edit your profile, check access logs, and manage media files easily.</p>
            <p>Please select any of the options below to get started:</p>
        </section>

        <div class="card-container">
            <div class="card" style="background-color: #3498db;">
                <a href="user_management.php">User Management</a>
            </div>
            <div class="card" style="background-color: #2ecc71;">
                <a href="message.php">Messages/Feedback</a>
            </div>
            <div class="card" style="background-color: #e74c3c;">
                <a href="admin_management.php">Admin Profile Settings</a>
            </div>
            <div class="card" style="background-color: #f39c12;">
                <a href="access_logs.php">Access Logs</a>
            </div>
            <div class="card" style="background-color: #8e44ad;">
                <a href="media_library.php">Media Library</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Electron Graphics. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                autoplay: true,
                dots: true,
                arrows: true,
            });
        });
    </script>
</body>

</html>
