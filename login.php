<?php
session_start(); // Start the session at the beginning of the script

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flab_u_less";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$user_email = $_POST['email']; // Assuming you're logging in with email
$user_password = $_POST['password'];

// Prepare SQL statement to prevent SQL injection
$sql = "SELECT id FROM member WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_email, $user_password);

// Execute and check results
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id']; // Store user ID in session
    header("Location: welcome.php"); // Redirect to welcome page
} else {
    // Login failed
    echo "Invalid email or password";
}

$conn->close();
?>
