<?php
// Database connection
$servername = "localhost";
$username = "root"; // your DB username
$password = ""; // your DB password
$dbname = "yoga_website"; // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Success alert and redirect
        echo "<script>
                alert('Message sent successfully!');
                window.location.href = 'contact.html'; 
              </script>";
    } else {
        // Error alert
        echo "<script>
                alert('Error while sending message.');
                window.location.href = 'contact.html';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
