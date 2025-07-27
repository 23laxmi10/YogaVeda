<?php
//Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "yoga_website"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Song
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['songFile']) && isset($_FILES['videoFile'])) {
    $title = $_POST['songTitle'];
    
    // File upload paths
    $audio_path = "img/" . basename($_FILES['songFile']['name']);
    $video_path = "img/" . basename($_FILES['videoFile']['name']);

    // Move uploaded files to respective directories
    if (move_uploaded_file($_FILES['songFile']['tmp_name'], $audio_path) && move_uploaded_file($_FILES['videoFile']['tmp_name'], $video_path)) {
        // Insert into database
        $sql = "INSERT INTO songs (title, audio_path, video_path) VALUES ('$title', '$audio_path', '$video_path')";
        if ($conn->query($sql) === TRUE) {
          //  echo "Song uploaded successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload files.";
    }
}

// Delete Song
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Get the song file paths before deleting
    $result = $conn->query("SELECT * FROM songs WHERE id = $id");
    $row = $result->fetch_assoc();

    // Delete files from the directory
    // unlink($row['audio_path']);
    // unlink($row['video_path']);

    // Delete from database
    $conn->query("DELETE FROM songs WHERE id = $id");
   // echo "Song deleted successfully!";
}

// Fetch all songs for displaying in the admin panel
$songs = $conn->query("SELECT * FROM songs");

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Song_edit Page</title>
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


    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


<body>
    <!-- Navbar and header -->
     

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
                    <h1 class="display-3 text-white animated slideInDown">Song</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Song</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
<!-- 404 Start -->
<div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Song</h6>
                <h1 class="mb-5">Meditation-Sound</h1>
            </div>

    <div class="container-xxl py-5">
        <div class="container">
            <!-- Display existing songs -->
            <div id="songList">
                <?php while ($song = $songs->fetch_assoc()) { ?>
                    <div class="song-container">
                        <div class="video-container">
                            <video src="<?php echo $song['video_path']; ?>" loop></video>
                        </div>
                        <h3><?php echo $song['title']; ?></h3>
                        <audio controls>
                            <source src="<?php echo $song['audio_path']; ?>" type="audio/mpeg">
                        </audio>
                        <a href="?delete=<?php echo $song['id']; ?>" class="btn btn-danger mt-2">Delete</a>
                    </div>
                <?php } ?>
            </div>

            <!-- Form to Add a New Song -->
            <div class="add-song-form mt-5">
                <h2>Add New Song</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="songTitle">Song Title</label>
                        <input type="text" name="songTitle" id="songTitle" class="form-control" placeholder="Enter song title" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="songFile">Song File (MP3)</label>
                        <input type="file" name="songFile" id="songFile" class="form-control" accept="audio/*" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="videoFile">Video File (MP4)</label>
                        <input type="file" name="videoFile" id="videoFile" class="form-control" accept="video/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Song</button>
                </form>
            </div>
        </div>
    </div>

<style>
    #songList {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px; /* Adjusts the space between song cards */
}

.song-container {
    width: 300px;
    background: white;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .playlist-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .song-container {
            width: 300px;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .video-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        video {
            width: 100%;
            max-width: 250px;
            border-radius: 12px;
        }
        h3 {
            margin: 10px 0;
        }
        audio {
            width: 100%;
            margin-top: 10px;
        }
    </style>

    <!-- <script>
        function deleteSong(button) {
            const songContainer = button.parentElement;
            songContainer.remove();
        }
    </script> -->
    <script>
        // Function to add a new song
        function addSong(event) {
            event.preventDefault();
            
            // Get values from the form
            const songTitle = document.getElementById('songTitle').value;
            const songFile = document.getElementById('songFile').files[0];
           const videoFile = document.getElementById('videoFile').files[0];

            // Create a new song container dynamically
            const songList = document.getElementById('songList');
            const newSong = document.createElement('div');
            newSong.classList.add('song-container');
            newSong.innerHTML = `
                <div class="video-container">
                    <video src="${URL.createObjectURL(videoFile)}" loop></video>
                </div>
                <h3>${songTitle}</h3>
                <audio controls>
                    <source src="${URL.createObjectURL(songFile)}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <button onclick="deleteSong(this)" class="btn btn-danger mt-2">Delete</button>
            `;
            songList.appendChild(newSong);

            // Clear the form
            document.getElementById('addSongForm').reset();
        }

        // Function to delete a song
        function deleteSong(button) {
            const songContainer = button.parentElement;
            songContainer.remove();
        }
    </script>

    <!-- Same footer and JS code as your original -->
</body>

</html>
