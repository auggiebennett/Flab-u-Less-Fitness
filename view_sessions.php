<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Now you have the user ID for the logged-in user
    // You can use $userId to query the database or for any other purpose
} else {
    // Redirect to login page or show an error message
    header("Location: index.php"); // Assuming 'index.php' is your login page
    exit;
}

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "flab_u_less";

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$memberId = $_SESSION['user_id']; // Get the member ID from session

// SQL to fetch personal training sessions for the logged-in user
$sql = "SELECT * FROM personal_training_session WHERE member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $memberId);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any sessions and display them
if ($result->num_rows > 0) {
    echo "<h1>Your Upcoming Personal Training Sessions</h1>";
    while($row = $result->fetch_assoc()) {
        echo "Session ID: " . $row["id"] . "<br>";
        echo "Trainer: " . $row["trainer"] . "<br>";
        echo "Start Time: " . $row["start_time"] . "<br>";
        echo "End Time: " . $row["end_time"] . "<br><hr>";
    }
} else {
    echo "No upcoming sessions found.";
}

$conn->close();
?>
