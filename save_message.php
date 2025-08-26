<?php
$messages_file_path = 'messages.json';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create an array to store the message
    $data = [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s')
    ];

    // Read the current data
    if (file_exists($messages_file_path)) {
        $current_data = file_get_contents($messages_file_path);
        $array_data = json_decode($current_data, true);
    } else {
        $array_data = []; // Initialize to empty array if file doesn't exist
    }

    // Add the new message to the array
    $array_data[] = $data;

    // Encode back to JSON and save
    file_put_contents($messages_file_path, json_encode($array_data));
}

// Read messages to display
if (file_exists($messages_file_path)) {
    $current_data = file_get_contents($messages_file_path);
    $messages = json_decode($current_data, true);
} else {
    $messages = []; // Initialize to empty array if file doesn't exist
}
header("Location: index.html");
?>