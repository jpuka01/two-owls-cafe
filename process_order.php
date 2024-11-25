<?php
include 'db_connection.php';
include 'header.php';

$subtotal = 0;
$taxRate = 0.0625; // 6.25% tax
$itemsOrdered = [];

foreach ($_GET as $key => $value) {
    if (strpos($key, 'quantity_') === 0 && $value > 0) {
        $id = str_replace('quantity_', '', $key);
        $query = "SELECT * FROM menu WHERE id = $id";
        $result = $conn->query($query);
        if ($row = $result->fetch_assoc()) {
            $itemTotal = $value * $row['price'];
            $subtotal += $itemTotal;

            $itemsOrdered[] = [
                'name' => $row['name'],
                'quantity' => $value,
                'price' => $row['price'],
                'total' => $itemTotal
            ];
        }
    }
}

$tax = $subtotal * $taxRate;
$total = $subtotal + $tax;

// Display order summary
echo "<h1>Order Summary</h1>";
foreach ($itemsOrdered as $item) {
    echo "<p>{$item['name']} x {$item['quantity']} = \${$item['total']}</p>";
}
echo "<p>Subtotal: \$$subtotal</p>";
echo "<p>Tax: \$$tax</p>";
echo "<p>Total: \$$total</p>";
echo "<p>Pickup Time: {$_GET['pickupTime']}</p>";
echo "<p>Special Instructions: {$_GET['specialInstructions']}</p>";

$conn->close();
?>
