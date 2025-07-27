<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Reading data from the text file
$data_file = "users.txt";
$lines = file($data_file, FILE_IGNORE_NEW_LINES);

// Handle deletion
if (isset($_GET['delete'])) {
    $delete_index = $_GET['delete'];
    if (isset($lines[$delete_index])) {
        unset($lines[$delete_index]);
        file_put_contents($data_file, implode("\n", $lines) . "\n");
        header("Location: shows_data.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .data-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table td {
            background-color: #f9f9f9;
        }
        a {
            color: red;
        }
    </style>
</head>
<body>

<div class="data-container">
    <h2>User Data</h2>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lines as $index => $line) {
            $data = explode("\t", trim($line));
            echo "<tr>";
            echo "<td>{$data[0]}</td>";
            echo "<td>{$data[1]}</td>";
            echo "<td>{$data[2]}</td>";
            echo "<td><a href='?delete={$index}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
