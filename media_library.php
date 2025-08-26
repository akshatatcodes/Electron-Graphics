<?php
// Start session and check if admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the upload directory
$uploadDir = 'uploads/';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['media_files']) && $_FILES['media_files']['error'][0] == 0) {
        // Loop through each uploaded file
        for ($i = 0; $i < count($_FILES['media_files']['name']); $i++) {
            if ($_FILES['media_files']['error'][$i] == 0) {
                $fileTmpPath = $_FILES['media_files']['tmp_name'][$i];
                $fileName = $_FILES['media_files']['name'][$i];

                // Ensure the uploads directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generate a unique file name to avoid collisions
                $destination = $uploadDir . uniqid() . '_' . $fileName;

                // Move the file to the uploads directory
                if (move_uploaded_file($fileTmpPath, $destination)) {
                    echo "File uploaded successfully: $fileName<br>";
                } else {
                    echo "There was an error uploading the file: $fileName<br>";
                }
            } else {
                echo "Error in file upload: $fileName<br>";
            }
        }
    } else {
        echo "No files selected or error in file upload.";
    }
}

// Handle file deletion
if (isset($_GET['delete'])) {
    $fileToDelete = $_GET['delete'];
    if (file_exists($uploadDir . $fileToDelete)) {
        unlink($uploadDir . $fileToDelete);
        echo "File deleted successfully.";
    } else {
        echo "File not found.";
    }
}

// Get list of files in the uploads directory
$files = scandir($uploadDir);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/media_library.css">
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
                <li class="nav-item nav-item-hover"><a class="nav-link" href="admin_management.php">Admin Profile Settings</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="access_logs.php">Access Logs</a></li>
                <li class="nav-item nav-item-hover"><a class="nav-link" href="logout.php">Logout</a></li>
                <li class="nav-item">
                    <input type="checkbox" id="dark_toggler" class="dark_toggler" aria-label="Toggle Light Mode" onclick="toggle_light_mode()" checked>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="title-section" style="margin-top: 80px;"> <!-- Adjust margin to accommodate fixed navbar -->
        <h1>Welcome to the Media Library</h1>
    </div>

    <!-- File upload form -->
    <form action="media_library.php" method="post" enctype="multipart/form-data" class="mb-4">
        <label for="media_files">Upload Media:</label>
        <input type="file" name="media_files[]" id="media_files" multiple required>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <hr>

    <h2>Uploaded Files</h2>
    <div class="container">
        <div class="row">
            <?php if (count($files) > 2): // Skip "." and ".." ?>
                <?php foreach ($files as $file): ?>
                    <?php if ($file != "." && $file != ".."): ?>
                        <div class="col-md-3"> <!-- 4 columns per row -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <?php
                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                    if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                        <img src="<?php echo $uploadDir . $file; ?>" class="img-fluid" alt="Media Image">
                                    <?php elseif (in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg'])): ?>
                                        <video width="100%" controls>
                                            <source src="<?php echo $uploadDir . $file; ?>" type="video/<?php echo $fileExtension; ?>">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php else: ?>
                                        <a href="<?php echo $uploadDir . $file; ?>" target="_blank"><?php echo $file; ?></a>
                                    <?php endif; ?>
                                    <a href="media_library.php?delete=<?php echo $file; ?>" onclick="return confirm('Are you sure you want to delete this file?');" class="btn btn-danger mt-2 btn-block">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No files uploaded yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Electron Graphics. All rights reserved.</p>
    </footer>
</body>
</html>
