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

// Fetch payment history for the logged-in user
$sql = "SELECT * FROM payment WHERE member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $memberId);
$stmt->execute();
$result = $stmt->get_result();

echo "<h1>Your Payment History</h1>";
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Member ID</th><th>Payment Date</th><th>Amount</th><th>Payment Method</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["member_id"] . "</td>";
        echo "<td>" . $row["payment_date"] . "</td>";
        echo "<td>" . $row["amount"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No payment history found.";
}

$conn->close();
?>
