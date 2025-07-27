<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "yoga_website"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch videos from the database
$query = "SELECT * FROM videos"; // Fetch all records from 'videos' table
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>vide Page</title>
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
                    <h1 class="display-3 text-white animated slideInDown">Video</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Video</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Video</h6>
                <h1 class="mb-5">playlist</h1>
            </div>
            
        </div>
    </div>
 <!-- Video Section Start -->
<div class="container py-5">
    
    <div class="row">
    <?php
if (mysqli_num_rows($result) > 0) {
    $counter = 0; // Initialize a counter to alternate videos
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="container-fluid p-0">';
        echo '    <div class="row align-items-center">';
        
        if ($counter % 2 == 0) {
            // For even videos: Video on left, text on right
            echo '
            <div class="col-lg-6 col-12">
                <video width="100%" height="300" controls>
                    <source src="' . $row['video_path'] . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>';
            echo '
            <div class="col-lg-6 col-12">
                <div class="px-5 py-5 py-lg-0 text-right">
                  
                    <h4><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</h4>
                  
                </div>
            </div>';
        } else {
            // For odd videos: Text on left, video on right
            echo '
            <div class="col-lg-6 col-12">
                <div class="px-5 py-5 py-lg-0">
                  
                    <h4><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</h4>
                    
                </div>
            </div>';
            echo '
            <div class="col-lg-6 col-12">
                <video width="100%" height="300" controls>
                    <source src="' . $row['video_path'] . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>';
        }

        echo '    </div>';
        echo '</div>';

        $counter++; // Increment the counter
    }
} else {
    echo '<p>No videos available at the moment.</p>';
}
?>

    </div>
</div>
<!-- Video Section End -->



    
    <style> 
        body {
            font-family: Arial, sans-serif;
        }
        
        /* Chatbot icon */
        .chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-image: url("img/bot2.webp");
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
      
        /* Chatbot container */
        .chatbot-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            z-index: 999; /* Ensure it's below the icon */
        }
      
        .chatbot-header {
            background: #6200ea;
            color: white;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
      
        .chatbot-body {
            padding: 10px;
            min-height: 200px;
        }
      
        .chatbot-input {
            border: none;
            padding: 10px;
            width: calc(100% - 20px);
            margin: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
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