<?php
require_once('connect.php');
require_once('ShoppingCart.php');

// Create a cart object
$cart = new ShoppingCart();

// Set the MySQLi connection
$cart->setConnection($conn);

// Set customer ID to test
$customerID = 1;

// Load the cart from the database
$cart->loadFromDatabase($customerID);

// Get the items
$items = $cart->getItems();

// Display the items
echo "<h2>Shopping Cart for Customer ID $customerID</h2>";

if (empty($items)) {
    echo "<p>The cart is empty.</p>";
} else {
    echo "<ul>";
    foreach ($items as $item) {
        echo "<li>Product ID: {$item['productID']}, Quantity: {$item['quantity']}, Price: {$item['price']}</li>";
    }
    echo "</ul>";
}
?>
