<?php
// DB connection
$host = "localhost";
$user = "root";
$password = "";
$db = "yoga_website";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['cloth-name'];
    $price = $_POST['cloth-price'];

    $imageName = $_FILES['cloth-img']['name'];
    $imageTmp = $_FILES['cloth-img']['tmp_name'];
    $imagePath = "img/" . $imageName;

    move_uploaded_file($imageTmp, $imagePath);

    $conn->query("INSERT INTO cloths (name, price, image) VALUES ('$name', '$price', '$imagePath')");
}

// Handle Delete
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $conn->query("DELETE FROM cloths WHERE id = $deleteId");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cloth Shop</title>
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
                    <h1 class="display-3 text-white animated slideInDown">Cloth</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Cloth</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* light blue background */
            margin: 20px;
        }
    
        .cloth-item {
            position: relative;
            border: 1px solid #d0e7ff;
            border-radius: 10px;
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    
        .remove-cloth {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 0.9em;
        }
    
        #add-cloth-btn {
            background-color: #3399ff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }
    
        #add-cloth-btn:hover {
            background-color: #007acc;
        }
    
        #add-cloth-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #e6f2ff;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #b3d9ff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
    
        #add-cloth-form h3 {
            margin-top: 0;
            color: #0066cc;
        }
    
        #cloth-form div {
            margin-bottom: 15px;
        }
    
        #cloth-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #003366;
        }
    
        #cloth-form input[type="text"],
        #cloth-form input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #99ccff;
            border-radius: 5px;
            box-sizing: border-box;
        }
    
        .btn-success {
            background-color: #33cc99;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    
        .btn-success:hover {
            background-color: #28a07a;
        }
    
        .btn-danger {
            background-color: #ff4d4d;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    
        .btn-danger:hover {
            background-color: #cc0000;
        }
    
        img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .back-arrow {
    display: inline-block;
    margin-bottom: 15px;
    cursor: pointer;
    font-size: 1.1em;
    color: #007acc;
    font-weight: bold;
    transition: color 0.2s ease;
}

.back-arrow:hover {
    color: #005c99;
    text-decoration: underline;
}
.cloth-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 items per row */
    gap: 20px;
    margin-top: 20px;
}
@media screen and (max-width: 992px) {
    .cloth-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media screen and (max-width: 576px) {
    .cloth-grid {
        grid-template-columns: 1fr;
    }
}


    </style>
    
</head>
<body>

<!-- Add New Cloth Button -->
<button id="add-cloth-btn" onclick="openForm()">Add New Cloth</button>

<!-- Add Cloth Modal -->
<div id="add-cloth-form">
    <span class="back-arrow" onclick="closeForm()">&#8592; Back</span>
    <h3>Add New Cloth</h3>
    <form id="cloth-form" method="POST" enctype="multipart/form-data">
        <div>
            <label for="cloth-name">Name:</label>
            <input type="text" id="cloth-name" name="cloth-name" required>
        </div>
        <div>
            <label for="cloth-price">Price:</label>
            <input type="text" id="cloth-price" name="cloth-price" required>
        </div>
        <div>
            <label for="cloth-img">Upload Image:</label>
            <input type="file" id="cloth-img" name="cloth-img" accept="image/*" required>
        </div>
        <button type="submit" class="btn-success">Add Cloth</button>
        <button type="button" class="btn-danger" onclick="closeForm()">Cancel</button>
    </form>
</div>

<!-- Display Cloths -->
<h2>Cloth Items</h2>
<div class="cloth-grid">
    <?php
    $result = $conn->query("SELECT * FROM cloths ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='cloth-item'>";
        echo "<img src='{$row['image']}' alt='Cloth Image'>";
        echo "<h4>{$row['name']}</h4>";
        echo "<p>Price: ₹{$row['price']}</p>";
        echo "<button class='remove-cloth' onclick='deleteCloth({$row['id']})'>Delete</button>";
        echo "</div>";
    }
    ?>
</div>

<script>
function openForm() {
    document.getElementById("add-cloth-form").style.display = "block";
}

function closeForm() {
    document.getElementById("add-cloth-form").style.display = "none";
}

function deleteCloth(id) {
    if (confirm("Are you sure you want to delete this cloth?")) {
        window.location.href = "cloth_edit.php?delete=" + id;
    }
}

</script>

</body>
</html>