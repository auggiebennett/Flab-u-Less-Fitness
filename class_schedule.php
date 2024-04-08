<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
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

// Fetch class schedule from database
$sql = "SELECT * FROM class ORDER BY start_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Schedule</title>
</head>
<body>
    <h1>Class Schedule</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Class Name</th><th>Instructor</th><th>Start Time</th><th>End Time</th><th>Max Participants</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["instructor"] . "</td><td>" 
                 . $row["start_time"] . "</td><td>" . $row["end_time"] . "</td><td>" 
                 . $row["max_participants"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No classes are available.";
    }
    $conn->close();
    ?>
</body>
</html>
