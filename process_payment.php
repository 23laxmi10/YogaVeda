
<?php
// Database connection
$host = 'localhost';
$dbname = 'payment_system';
$username = 'root';  // Default username for XAMPP
$password = '';      // Default password for XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO payments (name, email, card_number, expiry_date, cvv, amount) VALUES (:name, :email, :card_number, :expiry_date, :cvv, :amount)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':card_number', $card_number);
    $stmt->bindParam(':expiry_date', $expiry_date);
    $stmt->bindParam(':cvv', $cvv);
    $stmt->bindParam(':amount', $amount);

    // Collect and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $card_number = htmlspecialchars($_POST['card_number']);
    $expiry_date = htmlspecialchars($_POST['expiry_date']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $amount = htmlspecialchars($_POST['amount']);

    // Execute query
    $stmt->execute();
    echo "Payment successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
