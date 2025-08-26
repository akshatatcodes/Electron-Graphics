<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search users
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
}

// Get users
$sql = "SELECT * FROM register WHERE username LIKE '%$search_query%' OR email LIKE '%$search_query%'";
$result = $conn->query($sql);

// Delete user
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM register WHERE id = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "User deleted successfully!";
        header("Location: manage_users.php"); // Refresh page after deletion
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .search-box {
            margin-bottom: 20px;
        }
        /* Light/Dark theme variables for user management page */
html[data-theme="light"] {
  --bg-color: #f5f5f5;
  --text-color: #000;
  --box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

html[data-theme="dark"] {
  --bg-color: #2b2b2b;
  --text-color: #fff;
  --box-shadow: rgba(0, 0, 0, 0.5) 0px 4px 12px;
}

/* General page styling */
body {
  font-family: "Poppins", sans-serif;
  background-color: var(--bg-color);
  color: var(--text-color);
  transition: background-color 0.3s, color 0.3s;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

/* Table styling for managing users */
table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: var(--box-shadow);
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: var(--bg-color);
}

tr:hover {
  background-color: rgba(0, 0, 0, 0.1);
}

/* Button styling */
button {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #45a049;
}

button.delete {
  background-color: #f44336;
}

button.delete:hover {
  background-color: #d32f2f;
}

/* Responsive styles */
@media (max-width: 768px) {
  .container {
    padding: 10px;
  }

  table {
    font-size: 14px;
  }
}

    </style>
</head>
<body>

<h1>Manage Users</h1>

<div class="search-box">
    <form action="manage_users.php" method="POST">
        <input type="text" name="search_query" placeholder="Search by username or email" value="<?php echo $search_query; ?>">
        <input type="submit" name="search" value="Search">
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Age</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['mobile_number']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit_user.php?id={$row['id']}'>Edit</a> |
                        <a href='manage_users.php?delete_id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No users found</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="add_user.php">Add New User</a>

</body>
</html>

<?php
$conn->close();
?>
