<?php
session_start();

// Hardcoded admin credentials
$admin_user = "laxmi";
$admin_password = "laxmi123"; // You can change this


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if credentials are correct
    if ($username === $admin_user && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $username;
        header("Location: adminpage.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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
            <h1 id="formTitle">Welcome to Admin Login</h1>
        </div>
    <?php
    if (isset($error_message)) {
        echo "<p class='error'>{$error_message}</p>";
    }
    ?>

    <form method="POST" action="" id="loginForm" class="form">
    <div class="form-group">
                <label>name</label>
                <div class="input-group">
        <input type="text" name="username" placeholder="Username" required>
        </div>
        </div>

        <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button class="btn btn-primary" id="signInButton" type="submit">Login</button>
        </form>

</div>

</body>
</html>
