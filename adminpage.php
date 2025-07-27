<?php
session_start();
include 'db.php'; // Database connection for videos and poses

// Function to count total users from users.txt file
function getTotalUsersFromTxt() {
    $file = 'users.txt';
    
    // Check if the file exists
    if (!file_exists($file)) {
        return 0;
    }
    
    // Open the file and count the lines (each line is a user)
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return count($lines);
}

// Fetch total users from users.txt
$totalUsers = getTotalUsersFromTxt();

// Fetch total counts for videos and poses from the database
$totalVideos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM videos"))['count'];
$totalPoses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM poses"))['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #b3e5fc; /* Solid light blue background */
        }

        .sidebar {
            width: 250px;
            background-color: #0288d1; /* Light blue */
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            padding: 10px 20px;
            display: block;
            color: #fff;
            text-decoration: none;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: #0277bd; /* Darker blue on hover */
        }

        .dashboard {
            margin-left: 270px;
            padding: 20px;
            color: #333;
            background-color: #b3e5fc; /* Solid light blue background */
            height: 100vh; /* Ensure it covers the full height of the screen */
        }

        h2 {
            color: #0288d1; /* Heading in darker blue */
            font-size: 28px;
        }

        .cards {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 30px; /* Added gap between the cards */
        }

        .card {
            background-color: #ffffff;
            width: 30%;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            font-size: 20px;
            color: #0277bd; /* Subheading color */
        }

        .card p {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        .card a {
            display: block;
            margin-top: 15px;
            padding: 10px;
            background-color: #0288d1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #0277bd;
        }

        .logout {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #ff5252;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .logout:hover {
            background-color: #ff1744;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#">Home</a>
        <a href="admin_panel.php">Manage Users</a>
        <a href="video_edit.php">Manage Videos</a>
        <a href="manage_poses.php">Manage Poses</a>
        <a href="admin_songs.php">Manage Songs</a>
        <a href="cloth_edit.php">Manage Clothes</a>
        <a href="mat_edit.html">Manage Mats</a>
        <a href="payment_table.php">Manage Payments</a>
        <a href="admin_meeting.html">Manage Meeting</a>
    </div>
    <a href="logout.php">
    <button class="logout">Logout</button>
    </a>
    <div class="dashboard">
        <h2>Admin Dashboard</h2>

        <div class="cards">
            <div class="card">
                <h3>Total Users</h3>
                <p><?= $totalUsers; ?></p>
                <a href="admin_panel.php">Manage Users</a>
            </div>
            <div class="card">
                <h3>Total Videos</h3>
                <p><?= $totalVideos; ?></p>
                <a href="video_edit.php">Manage Videos</a>
            </div>
            <div class="card">
                <h3>Total Poses</h3>
                <p><?= $totalPoses; ?></p>
                <a href="manage_poses.php">Manage Poses</a>
            </div>
        </div>
    </div>
</body>
</html>
