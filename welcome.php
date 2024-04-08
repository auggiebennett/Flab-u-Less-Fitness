<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            margin: 5px 0;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        li a {
            color: white;
            text-decoration: none;
            display: block;
        }
        li a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Fitness Center!</h1>
        <p>Select from the options below:</p>
        <ul>
            <li><a href="view_sessions.php">View Personal Training Sessions</a></li>
            <li><a href="class_schedule.php">Check Class Schedule</a></li>
            <li><a href="booking.php">Manage Bookings</a></li>
            <li><a href="profile.php">Update Personal Information</a></li>
            <li><a href="payment_history.php">View Payment History</a></li>
        </ul>
    </div>
</body>
</html>
