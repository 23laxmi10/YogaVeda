<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Light blue background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .checkout-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #0077b6; /* Darker blue for heading */
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #0077b6;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 60px;
        }

        .payment-method {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #0077b6;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #005f8d; /* Darker blue on hover */
        }
    </style>
</head>
<body>

<div class="checkout-container">
    <a href="cloths.html" class="back-btn">Back to Home</a>
    <h2>Payment</h2>

    <?php
    // Database connection details
    $servername = "localhost"; // Change if needed
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "yoga_website"; // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create cloths_payment table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS cloths_payment (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(15) NOT NULL,
        address TEXT NOT NULL,
        payment_method VARCHAR(10) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === FALSE) {
        die("Error creating table: " . $conn->error);
    }

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if all fields are set
        if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['payment_method'])) {
            // Get the form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $payment_method = $_POST['payment_method'];

            // Prepare the SQL statement to insert data
            $stmt = $conn->prepare("INSERT INTO cloths_payment (name, email, phone, address, payment_method) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $phone, $address, $payment_method);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<p style='color:green; text-align:center;'>Order placed successfully!</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Error: " . $stmt->error . "</p>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<p style='color:red; text-align:center;'>Error: All fields are required.</p>";
        }
    }

    // Close the connection
    $conn->close();
    ?>

    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>

        <div class="payment-method">
    <label>Payment Method:</label>
    <label>
        <input type="radio" name="payment_method" value="online" required onclick="handlePayment(this.value)">
        Online Payment
    </label>
    <label>
        <input type="radio" name="payment_method" value="cod" required onclick="handlePayment(this.value)">
        Cash on Delivery
    </label>
</div>

<script>
function handlePayment(method) {
    if (method === "online") {
        // Open new page in the same tab or new tab
        window.open("payment_form.html"); 
    }
}
</script>


        <input type="submit" value="Place Order">
    </form>
</div>

</body>
</html>
