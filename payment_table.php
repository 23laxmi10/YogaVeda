<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM payments WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request
if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    $amount = $_POST['amount'];

    $edit_sql = "UPDATE payments SET name='$name', email='$email', card_number='$card_number', expiry_date='$expiry_date', cvv='$cvv', amount='$amount' WHERE id=$edit_id";

    if ($conn->query($edit_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle add new user request
if (isset($_POST['add_user'])) {
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];
    $new_card_number = $_POST['new_card_number'];
    $new_expiry_date = $_POST['new_expiry_date'];
    $new_cvv = $_POST['new_cvv'];
    $new_amount = $_POST['new_amount'];

    $add_sql = "INSERT INTO payments (name, email, card_number, expiry_date, cvv, amount, created_at) 
                VALUES ('$new_name', '$new_email', '$new_card_number', '$new_expiry_date', '$new_cvv', '$new_amount', NOW())";

    if ($conn->query($add_sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error adding new record: " . $conn->error;
    }
}

// Fetch payment records
$sql = "SELECT * FROM payments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .edit-btn, .delete-btn, .back-btn, .add-btn {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .back-btn {
            background-color: #2196F3;
        }

        .add-btn {
            background-color: #4CAF50;
        }

        .add-form {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
        }

        .add-form input {
            margin: 5px 0;
            padding: 8px;
            width: 200px;
        }
    </style>
</head>
<body>

<h2>Payment Records</h2>

<a href="adminpage.php" class="back-btn">← Back</a>

<!-- Display existing records -->
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Card Number</th>
        <th>Expiry Date</th>
        <th>CVV</th>
        <th>Amount</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        // Output data for each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<form method='POST' action=''>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><input type='text' name='name' value='" . $row["name"] . "'></td>";
            echo "<td><input type='text' name='email' value='" . $row["email"] . "'></td>";
            echo "<td><input type='text' name='card_number' value='" . $row["card_number"] . "'></td>";
            echo "<td><input type='text' name='expiry_date' value='" . $row["expiry_date"] . "'></td>";
            echo "<td><input type='text' name='cvv' value='" . $row["cvv"] . "'></td>";
            echo "<td><input type='text' name='amount' value='" . $row["amount"] . "'></td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "<td>
                    <input type='hidden' name='edit_id' value='" . $row["id"] . "'>
                    <input type='submit' name='edit' class='edit-btn' value='Edit'>
                  </form>
                  <form method='POST' action='' style='display:inline'>
                    <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                    <input type='submit' name='delete' class='delete-btn' value='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'>
                  </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No records found</td></tr>";
    }
    ?>
</table>

<!-- Add new user form -->
<div class="add-form">
    <h3>Add New Payment Record</h3>
    <form method="POST" action="">
        <input type="text" name="new_name" placeholder="Name" required>
        <input type="email" name="new_email" placeholder="Email" required>
        <input type="text" name="new_card_number" placeholder="Card Number" required>
        <input type="text" name="new_expiry_date" placeholder="Expiry Date (MM/YY)" required>
        <input type="text" name="new_cvv" placeholder="CVV" required>
        <input type="number" name="new_amount" placeholder="Amount" required>
        <input type="submit" name="add_user" class="add-btn" value="Add Record">
    </form>
</div>

<?php $conn->close(); ?>

</body>
</html>
