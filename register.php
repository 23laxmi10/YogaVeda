<?php
    session_start();

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        // Basic validation (this should be improved for production use)
        if (!empty($fullname) && !empty($email) && !empty($password) && $password == $confirmPassword) {
            
            // Save data to users.txt file
            $userData = $fullname . "\t" . $email . "\t" . $password . "\n";
            file_put_contents('users.txt', $userData, FILE_APPEND | LOCK_EX);

            // Redirect to login page or show success message
            $_SESSION['message'] = 'Registration successful! You can now log in.';
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['error'] = 'Error: Please fill all the fields correctly!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - YOGAVEDA</title>
    <link rel="stylesheet" href="css/style.css">
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
                <i class="fa fa-hand-o-left"></i> Back to Home
            </a>
        </div>
        <div class="header">
            <h1>Create Account</h1>
        </div>

        <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert error">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
        ?>

        <form method="POST" action="" id="registerForm" class="form">
        <div id="registerAlert" class="alert hidden"></div>    
        <div class="form-group">
                <label>Full Name</label>
                <div class="input-group">
                <input type="text" name="fullname" placeholder="John Doe" required>
                </div>
            </div>
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
            <div class="form-group">
                <label>Confirm Password</label>
                <div class="input-group">
                <input type="password" name="confirmPassword" placeholder="••••••••" required>
            </div>
            </div>
            <button class="favorite styled" type="submit" id="submitBtn">Create Account</button>
        </form>

        <div class="toggle-form">
            <a href="login.php">
            <button id="toggleForm" class="toggle-btn">You have an account? SignIn</button>
            </a>
        </div>
    </div>
</body>
</html>
