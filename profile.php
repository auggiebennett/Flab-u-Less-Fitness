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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Personal Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
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
    ?>
</div>
</body>
</html>

<?php
$conn->close();
?>
