<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
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

// Fetch all information from the member table for the logged-in user
$sql = "SELECT * FROM member WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $memberId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h1>Your Personal Information</h1>";
    $row = $result->fetch_assoc();
    echo "<form method='post' action='update_info.php'>";
    echo "ID: " . $row["id"] . "<br>";
    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
    echo "Name: <input type='text' name='name' value='" . $row["name"] . "'><br>";
    echo "Email: <input type='text' name='email' value='" . $row["email"] . "'><br>";
    echo "Phone: <input type='text' name='phone' value='" . $row["phone"] . "'><br>";
    echo "Join Date: " . $row["join_date"] . "<br>";
    echo "Membership Status: " . $row["membership_status"] . "<br>";
    echo "Payment Info: " . $row["payment_info"] . "<br>";
    echo "Communication Preferences: <input type='text' name='communication_preferences' value='" . $row["communication_preferences"] . "'><br>";
    echo "Password: <input type='password' name='password' value='" . $row["password"] . "'><br>";
    echo "<input type='submit' value='Update'>";
    echo "</form>";
} else {
    echo "No member found.";
}

$conn->close();
?>
