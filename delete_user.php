<?php
    include('db.php');

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        
        // SQL to delete user
        $deleteQuery = "DELETE FROM register WHERE id = $userId";
        
        if (mysqli_query($conn, $deleteQuery)) {
            // Redirect to the user management page after deletion
            header('Location: user_management.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>
