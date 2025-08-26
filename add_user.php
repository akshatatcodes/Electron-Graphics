<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user into the database
    $sql = "INSERT INTO register (full_name, username, age, mobile_number, email, password) 
            VALUES ('$full_name', '$username', $age, '$mobile_number', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <style>
        /* Reset default margins and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Basic body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        /* Container for centering the form */
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 600px;
        }

        /* Heading styling */
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Label styling */
        label {
            margin-bottom: 8px;
            font-size: 16px;
            color: #555;
        }

        /* Input field styling */
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            width: 100%;
        }

        /* Submit button styling */
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Link styling */
        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Add New User</h1>

    <form action="add_user.php" method="POST">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="age">Age:</label>
        <input type="number" name="age" required>

        <label for="mobile_number">Mobile Number:</label>
        <input type="text" name="mobile_number" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Add User">
    </form>

    <a href="manage_users.php">Back to Manage Users</a>
</div>

</body>
</html>
