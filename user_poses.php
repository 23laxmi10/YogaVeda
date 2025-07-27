<?php
// user_poses.php - User view

// Database connection
$servername = "localhost";
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "yoga_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>index Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fas fa-spa"></i>  YOGAVEDA</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link">Home</a>
                
                <a href="about.html" class="nav-item nav-link">About</a>
                <!-- <a href="courses.html" class="nav-item nav-link">Pose</a> -->

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Info</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="user_poses.php" class="dropdown-item">Pose</a>
                        <a href="user_video.php" class="dropdown-item">Video</a>
                        <a href="songs.php" class="dropdown-item">Song</a>
                    </div>
                </div>

                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Shop</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="cloths.html" class="dropdown-item">Cloths</a>
                        <a href="mat.html" class="dropdown-item">Mats</a>
                        <!-- <a href="404.html" class="dropdown-item">404 Page</a> -->
                    </div>
                </div>
                <a href="live.html" class="nav-item nav-link">Live</a>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>

            <div class="d-flex align-items-center me-4">
                <a href="user_logout.php">
                <button class="favorite styled" type="button">Logout</button>
                  </a>
                <!-- a href="admin_login.php">
                <button class="favorite styled" type="button">Admin</button>
                </a>  --->
            </div> 

            <!-- <a href="Login.html" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i class="fa fa-arrow-right ms-3"></i></a> -->
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Pose</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Pose</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Pose</h6>
            <h1 class="mb-5">Strength – Warrior</h1>
        </div>



        <div class="poses-container">
    <?php
    // Fetch all poses from the database
    $result = $conn->query("SELECT * FROM poses");
    while ($row = $result->fetch_assoc()) {
        echo ' <div class="team-container">';
        echo '    <div class="team-item">';
        echo '        <div class="card-inner">';
        echo '            <div class="front">';
        echo '                <img src="' . $row['pose_file'] . '" alt="' . $row['pose_name'] . '">';
        echo '                <h5>' . $row['pose_name'] . '</h5>';
        echo '                <small>' . $row['pose_type'] . '</small>';
        echo '            </div>';
        echo '            <div class="back">';
        echo '                <p>' . $row['description'] . '</p>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
    ?>
</div>
</div>
</div>
<style>
    /* Container holding all poses */
    .poses-container {
        display: flex;
        flex-wrap: wrap; /* Ensure items wrap in a row */
        gap: 20px; /* Gap between items */
        justify-content: flex-start; /* Align items from left */
    }

    /* Individual pose item container */
    .pose-item {
        width: 300px; /* Fixed width for consistency */
        height: 400px; /* Fixed height */
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    /* Pose card content */
    .pose-card {
        width: 100%;
        padding: 15px;
        text-align: center;
    }

    /* Front content (image, name, type) */
    .pose-front img {
        width: 100%; /* Ensure the image fits the card */
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    .pose-front h5, .pose-front small {
        margin: 10px 0;
    }

    /* Delete button styling */
    .delete-btn {
        display: inline-block;
        margin-top: 10px;
        background-color: red;
        color: white;
        padding: 5px 10px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: darkred;
    }

    /* Description text */
    p {
        padding: 10px;
        text-align: left;
    }
</style>
 <!-- Footer Start -->
 <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>678 Street, Ghatkopar, Mumbai</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 8450906798</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>Yogaveda@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://x.com/?lang=en"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/accounts/login/?hl=en"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/aboutus1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/2yogapose.webp" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/4img.webp" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/sub2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/foot1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/foot2.webp" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Ready to start your yoga journey? Get in touch with us today to book
                        your first online class and transform your practice!</p>
                    <!-- <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        <!-- Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> -->
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

     <div class="whatsapp_main">
        <a href ="tracking.html"><img src="img/pro.webp" width="20%" class ="whatsapp_img">
        </a>
     </div>
         
<!-- Chatbot Floating Button -->  

<div id="chatbot-button" onclick="openChatbot()">
    <img src="img/bot2.webp" alt="Chat">
</div>

<script>
// Function to open chatbot.php when image is clicked
function openChatbot() {
    window.location.href = "chatbot.php";
}
</script>


    
    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

