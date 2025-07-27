<?php
session_start();

// Check if admin is logged in
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: admin_login.php");
//     exit();
// }

// Reading data from the text file
$data_file = "users.txt";
$lines = file($data_file, FILE_IGNORE_NEW_LINES);

// Handle deletion
if (isset($_GET['delete'])) {
    $delete_index = $_GET['delete'];
    if (isset($lines[$delete_index])) {
        unset($lines[$delete_index]);
        file_put_contents($data_file, implode("\n", $lines) . "\n");
        header("Location: admin_panel.php");
        exit();
    }
}

// Handle updating
if (isset($_POST['update'])) {
    $update_index = $_POST['update_index'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $lines[$update_index] = "$name\t$email\t$password";
    file_put_contents($data_file, implode("\n", $lines) . "\n");
    header("Location: admin_panel.php");
    exit();
}

// Handle adding new user
if (isset($_POST['add_user'])) {
    $name = $_POST['new_name'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Append new user data to the file
        $new_user = "$name\t$email\t$password\n";
        file_put_contents($data_file, $new_user, FILE_APPEND);
        header("Location: admin_panel.php");
        exit();
    } else {
        $error_message = "All fields are required to add a new user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Login - YOGAVEDA</title>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Heebo', sans-serif;
            background-color: #f0f0f5;
            color: #333;
        }

        .navbar {
            background-color: rgb(55, 199, 222); /* Purple navbar */
            padding: 15px;
            display: flex;
            justify-content: center;
        }

        .nav-brand h2 {
            font-size: 28px;
            color: rgb(2, 10, 8); /* Aqua logo text */
            display: flex;
            align-items: center;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            max-width: 800px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #1abc9c;
            color: #fff;
            font-weight: bold;
        }

        table td input {
            width: 100%;
            padding: 5px;
            text-align: center;
        }

        table td button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .logout a {
            color: #e74c3c; /* Logout in red */
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .form-container .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <h2 class="m-0 text-primary">YOGAVEDA</h2>
        </div>
    </nav>

    <div class="form-container">
        <div class="back-button">
            <a href="adminpage.php">Back to Home</a>
        </div>

        <div class="header">
            <h1>Welcome, Admin</h1>
            <h3>User Data</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lines as $index => $line): ?>
                <?php $data = explode("\t", trim($line)); ?>
                <tr>
                    <form method="POST" action="">
                        <td><input type="text" name="name" value="<?php echo $data[0]; ?>"></td>
                        <td><input type="email" name="email" value="<?php echo $data[1]; ?>"></td>
                        <td><input type="text" name="password" value="<?php echo $data[2]; ?>"></td>
                        <td>
                            <input type="hidden" name="update_index" value="<?php echo $index; ?>">
                            <button type="submit" name="update">Update</button>
                        </td>
                    </form>
                    <td><a href="?delete=<?php echo $index; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add New User Form -->
        <h3>Add New User</h3>
        <form method="POST" action="">
            <input type="text" name="new_name" placeholder="Full Name" required>
            <input type="email" name="new_email" placeholder="Email" required>
            <input type="text" name="new_password" placeholder="Password" required>
            <button type="submit" name="add_user">Add User</button>
        </form>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
