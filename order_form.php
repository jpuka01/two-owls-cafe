<?php
// Database connection
include 'db_connection.php';

// Fetch the menu items from the database
$query = "SELECT * FROM menu";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Owls Cafe - Order Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include './header.php'; ?>

    <h1>Two Owls Cafe Order Form</h1>
    <form method="GET" action="process_order.php" id="order_form">
        <div class="menu-items">
            <?php
            // Display each item from the menu
            while ($row = $result->fetch_assoc()) {
                echo "<div class='menu-item'>";
                echo "<img src='https://johnp392.sg-host.com/images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p>Price: $" . $row['price'] . "</p>";
                echo "<label for='quantity_" . $row['id'] . "'>Quantity:</label>";
                echo "<select name='quantity_" . $row['id'] . "' id='quantity_" . $row['id'] . "'>";
                for ($i = 0; $i <= 10; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                echo "</select>";
                echo "</div>";
            }
            ?>
        </div>
        
        <!-- Additional Fields -->
         <div class="user-details">
            <h3>Your Details</h3>
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName" required>
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" required>
            <label for="specialInstructions">Special Instructions:</label>
            <textarea name="specialInstructions" id="specialInstructions"></textarea>

            <!-- Hidden Field (Pickup Time) -->
            <input type="hidden" name="pickupTime" id="pickupTime">
         </div>

        <button type="submit">Submit Order</button>
    </form>

    <script src="order_validation.js"></script>
</body>
</html>
