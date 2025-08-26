
<?php
// Include your database connection file
include('db.php'); // Adjust the path to your database connection file

// Check if the admin ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch admin data from the database
    $query = "SELECT * FROM admins WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated admin data from the form
    $admin_name = $_POST['admin_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update admin information in the database
    $updateQuery = "UPDATE admins SET admin_name='$admin_name', username='$username', email='$email' WHERE id='$id'";
    
    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to admin management page after successful update
        header("Location: admin_management.php");
        exit(); // Make sure to exit after header redirect
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <style>
        /* General Body Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Light grey background */
            color: #333333; /* Dark grey text color */
            margin: 0;
            display: flex;
            justify-content: center; /* Center the container horizontally */
            align-items: center; /* Center the container vertically */
            height: 100vh; /* Full viewport height */
        }

        .container {
            background-color: #ffffff; /* White background for the form */
            padding: 30px; /* Padding around the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            width: 400px; /* Fixed width for the form */
        }

        /* Heading Styles */
        h2 {
            text-align: center; /* Center the heading */
            margin-bottom: 20px; /* Space below the heading */
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 15px; /* Space below each form group */
        }

        /* Label Styles */
        label {
            display: block; /* Block display for labels */
            margin-bottom: 5px; /* Space below each label */
            font-weight: bold; /* Bold text for labels */
        }

        /* Input Styles */
        .form-control {
            width: 100%; /* Full width for inputs */
            padding: 10px; /* Padding inside inputs */
            border: 1px solid #cccccc; /* Light grey border */
            border-radius: 4px; /* Rounded corners */
            font-size: 16px; /* Font size */
        }

        /* Input Focus Styles */
        .form-control:focus {
            border-color: #007bff; /* Blue border on focus */
            outline: none; /* Remove outline */
        }

        /* Button Styles */
        .btn {
            background-color: #007bff; /* Blue background for button */
            color: #ffffff; /* White text for button */
            padding: 10px 15px; /* Padding inside button */
            border: none; /* Remove border */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size */
            width: 100%; /* Full width for the button */
        }

        /* Button Hover Styles */
        .btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Admin</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="admin_name">Admin Name</label>
            <input type="text" id="admin_name" name="admin_name" class="form-control" value="<?php echo $admin['admin_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="<?php echo $admin['username']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $admin['email']; ?>" required>
        </div>
        <button type="submit" class="btn">Update Admin</button>
    </form>
</div>
</body>
</html>