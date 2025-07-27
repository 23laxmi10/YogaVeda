<?php
// manage_poses.php - Admin view

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

// Handle form submission to add poses
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pose_type = $_POST['pose_type'];
    $pose_name = $_POST['pose_name'];
    $description = $_POST['description'];

    // Handle file upload
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["pose_file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size (limit to 2MB)
    if ($_FILES["pose_file"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats (e.g., JPG, PNG, MP4)
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "mp4" && $fileType !="jpeg" && $fileType !="webp") {
        echo "Sorry, only JPG, PNG, and MP4 files are allowed.";
        $uploadOk = 0;
    }

    // Check if file upload is OK
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["pose_file"]["tmp_name"], $target_file)) {
            // Insert pose into database
            $sql = "INSERT INTO poses (pose_type, pose_name, pose_file, description) VALUES ('$pose_type', '$pose_name', '$target_file', '$description')";

            if ($conn->query($sql) === TRUE) {
                echo "New pose added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Handle deletion of poses
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM poses WHERE id = $id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Pose deleted successfully.";
    } else {
        echo "Error deleting pose: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>poses  upload</title>
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

   <!-- //Navbar Start -->
   <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fas fa-spa"></i>  YOGAVEDA</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-flex align-items-center me-4">
                <a href="adminpage.php">
                <button class="favorite styled" type="button">Back
        
                </button>
                  </a>
</nav>

<!-- Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white">Pose Gallery</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item text-white active">Pose Upload</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

    <h2>Add a New Pose</h2>

    <form action="manage_poses.php" method="post" enctype="multipart/form-data">
        <label for="pose_type">Pose Type:</label>
        <input type="text" name="pose_type" id="pose_type" required><br><br>

        <label for="pose_name">Pose Name:</label>
        <input type="text" name="pose_name" id="pose_name" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="pose_file">Pose File (JPG, PNG, MP4 only):</label>
        <input type="file" name="pose_file" id="pose_file" required><br><br>

        <button type="submit">Add Pose</button>
    </form>

    <h2>Existing Poses</h2>
<div class="container-xxl py-5">
    <div class="container">
        <div class="poses-container">
            <?php
            // Fetch all poses from the database
            $result = $conn->query("SELECT * FROM poses");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="pose-item">';
                echo '    <div class="pose-card">';
                echo '        <div class="pose-front">';
                echo '            <img src="' . $row['pose_file'] . '" alt="' . $row['pose_name'] . '">';
                echo '            <h5>' . $row['pose_name'] . '</h5>';
                echo '            <small>' . $row['pose_type'] . '</small>';
                echo '            <a href="manage_poses.php?delete=' . $row['id'] . '" class="delete-btn">Delete</a>';
                echo '        </div>';
                echo '        <p>' . $row['description'] . '</p>';
                echo '    </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Add the required CSS -->
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




</body>
</html>

<?php
$conn->close();
?>
