<?php
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $isAuthenticated = false;
    $userName = '';

    // Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address.";
    } else {
        // Read the users.txt file to check for credentials
        $file = fopen('users.txt', 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                list($fullname, $userEmail, $userPassword) = explode("\t", trim($line));

                // Check if email and password match
                if ($email == $userEmail && $password == $userPassword) {
                    $isAuthenticated = true;
                    $userName = $fullname;
                    break;
                }
            }
            fclose($file);
        }

        if ($isAuthenticated) {
            // Store user data in session
            $_SESSION['user'] = [
                'name' => $userName,
                'email' => $email
            ];

            // Log session data to data.txt
            $logData = "User: " . $userName . " - Email: " . $email . " - Logged in at: " . date('Y-m-d H:i:s') . "\n";
            file_put_contents('data.txt', $logData, FILE_APPEND | LOCK_EX);

            // Redirect to the homepage or dashboard
            header('Location: index.html');
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - YOGAVEDA</title>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-brand">
            <h2 class="m-0 text-primary"><i class="fas fa-spa"></i> YOGAVEDA</h2>
        </div>
    </nav>

    <div class="form-container">
        <div class="back-button">
            <a href="home.html" class="back-to-home">
                <i class="fa fa-hand-o-left" style="font-size:24px"></i> Back to Home
            </a>
        </div>

        <div class="header">
            <h1 id="formTitle">Welcome to User Login</h1>
        </div>

        <!-- Display PHP session errors -->
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <!-- Login Form -->
        <form id="loginForm" class="form" action="" method="POST">
            <div id="loginAlert" class="alert hidden"></div>

            <div class="form-group">
                <label>Email</label>
                <div class="input-group">
                    <input type="email" name="email" placeholder="you@example.com" required>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button class="btn btn-primary" id="signInButton" type="submit">Sign In</button>
        </form>

        <!-- Register Link -->
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('loginForm');
            const loginAlert = document.getElementById('loginAlert');

            // Helper functions
            function showAlert(type, message) {
                loginAlert.className = `alert ${type}`;
                loginAlert.innerHTML = message;
                loginAlert.classList.remove('hidden');
            }
        });
    </script>
</body>

</html>
