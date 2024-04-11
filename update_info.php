<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $communication_preferences = $_POST['communication_preferences'];
    $password = $_POST['password'];

    // Update member information in the database
    $sql = "UPDATE member SET name=?, email=?, phone=?, communication_preferences=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $phone, $communication_preferences, $password, $id);
    
    if ($stmt->execute()) {
        echo "Member information updated successfully";
    } else {
        echo "Error updating member information: " . $conn->error;
    }

    $conn->close();
} else {
    // Redirect to the main page if accessed directly without form submission
    header("Location: index.php");
    exit;
}
?>
