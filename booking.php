<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
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

// Fetch user's bookings
$sql = "SELECT b.*, c.name AS class_name FROM booking b LEFT JOIN class c ON b.reference_id = c.id WHERE b.member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $memberId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
</head>
<body>
    <h1>Your Bookings</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Booking ID</th>
                <th>Class Name</th>
                <th>Booking Date</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['class_name']) ?></td>
                    <td><?= htmlspecialchars($row['booking_date']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>

    <h2>Book a Class</h2>
    <form action="make_booking.php" method="post">
        <label for="class">Class:</label>
        <select name="class_id" id="class">
            <?php
            // Fetch and display classes for booking
            $sql = "SELECT id, name FROM class";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Book Class">
    </form>
</body>
</html>
