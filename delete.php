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
    <title>Delete Order - Local Shop</title>
    <link rel="stylesheet" href="edit.css">
    <style>
        .delete-confirm {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #fff8f8;
            border: 1px solid #ffdddd;
            border-radius: 10px;
            text-align: center;
        }
        .delete-confirm p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .delete-confirm button,
        .delete-confirm a {
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            margin: 0 10px;
            cursor: pointer;
        }
        .delete-confirm .yes {
            background-color: red;
            color: white;
        }
        .delete-confirm .no {
            background-color: #ccc;
            color: black;
        }
    </style>
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
    <div class="delete-confirm">
        <h1>Confirm Deletion</h1>
        <p>Are you sure you want to delete this order?</p>
        <p>
            <strong>Customer ID:</strong> <?= htmlspecialchars($customerID) ?><br>
            <strong>Brand ID:</strong> <?= htmlspecialchars($brandID) ?><br>
            <strong>Status:</strong> <?= htmlspecialchars($status) ?>
        </p>
        <form action="deleteorder.php" method="post" style="display:inline;">
            <input type="hidden" name="orderID" value="<?= htmlspecialchars($orderID) ?>">
            <button type="submit" class="yes">Yes, Delete</button>
        </form>
        <a href="create.php" class="no">No, Cancel</a>
    </div>
</main>

<footer>
    <p>&copy; 2025 Local Shop. All rights reserved.</p>
</footer>
</body>
</html>
