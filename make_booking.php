<?php
session_start();

// Check if the user is logged in and the form was submitted
if (!isset($_SESSION['user_id']) || !isset($_POST['class_id'])) {
    header("Location: index.php"); // Redirect to login page if not logged in or form not submitted
    exit;
}

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

$memberId = $_SESSION['user_id']; // Get user ID from session
$classId = $_POST['class_id']; // Get class ID from submitted form
$bookingDate = date("Y-m-d"); // Use current date for booking date or fetch from a form if necessary
$status = "Booked"; // Default status

// Insert the booking into the database
$sql = "INSERT INTO booking (member_id, booking_date, booking_type, reference_id, status) VALUES (?, ?, 'Class', ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issi", $memberId, $bookingDate, $classId, $status);

if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
