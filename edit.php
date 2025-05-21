<?php
require_once "connect.php";

// Check if orderID is set
if (!isset($_GET["orderID"]) || empty(trim($_GET["orderID"]))) {
    echo "Invalid order ID.";
    exit();
}

$orderID = trim($_GET["orderID"]);

// Fetch order from database
$sql = "SELECT * FROM orders WHERE orderID = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $order = $result->fetch_assoc();
        $customerID = $order["customerID"];
        $brandID = $order["brandID"];
        $status = $order["status"];
    } else {
        echo "Order not found.";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order - Local Shop</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
<header>
    <div class="logo">LOCAL SHOP</div>
    <nav>
        <a href="#">HOME</a>
        <a href="#">ABOUT US</a>
        <a href="#">BRANDS</a>
        <a href="#">CATEGORIES</a>
        <a href="#">CONTACT US</a>
    </nav>
    <div class="icons">
        <button>Login</button>
    </div>
</header>

<main>
    <h1>Edit Order</h1>
   <div class="form-section">
    <form action="updateorder.php" method="post">
        <input type="hidden" name="orderID" value="<?= htmlspecialchars($orderID) ?>">

        <label for="customerID">Customer ID</label><br>
        <input type="text" id="customerID" name="customerID" placeholder="Customer ID" value="<?= htmlspecialchars($customerID) ?>" required><br><br>

        <label for="brandID">Brand ID</label><br>
        <input type="text" id="brandID" name="brandID" placeholder="Brand ID" value="<?= htmlspecialchars($brandID) ?>" required><br><br>

        <label for="status">Status</label><br>
        <select id="status" name="status" required>
            <option value="">Select Status</option>
            <option value="pending" <?= $status == "pending" ? "selected" : "" ?>>Pending</option>
            <option value="processing" <?= $status == "processing" ? "selected" : "" ?>>Processing</option>
            <option value="shipped" <?= $status == "shipped" ? "selected" : "" ?>>Shipped</option>
            <option value="delivered" <?= $status == "delivered" ? "selected" : "" ?>>Delivered</option>
            <option value="cancelled" <?= $status == "cancelled" ? "selected" : "" ?>>Cancelled</option>
        </select><br><br>

        <button type="submit">Update Order</button>
        <a href="create.php" class="cancel-btn">Cancel</a>
    </form>
</div>

</main>

<footer>
    <p>&copy; 2025 Local Shop. All rights reserved.</p>
</footer>
</body>
</html>
