<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Local Shop - Manage Orders</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <header>
        <div class="logo">LOCAL SHOP</div>
        <nav>
            <a href="#">HOME</a>
            <a href="#">ABOUT US</a>
            <a href="#">BRANDS</a>
            <a href="#">CATEGORIES</a>
            <a href="#">NOTIFICATIONS</a>
            <a href="#">CONTACT US</a>
            

        </nav>
        <div class="icons">
            <button>Login</button>
        </div>
    </header>

    <main>
      <!-- <h1>Manage Orders</h1>
        <div class="form-section">
            <form action="createorder.php" method="post">
                <h2>Create Order</h2>
                <input type="text" name="customerID" placeholder="Customer ID" required>
                <input type="text" name="brandID" placeholder="Brand ID" required>
                <select name="status" required>
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button type="submit">Add Order</button>
            </form>
        </div>-->

         <!-- Table Section to Display Orders -->
        <div class="table-section">
            <h2>Order List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th>Brand ID</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    require_once('connect.php');

                    // Query to fetch all orders from the orders table
                    $sql = "SELECT orderID, customerID, brandID, status FROM orders"; 
                    $result = $conn->query($sql);

                    // Check if there are any rows returned from the query
                    if ($result->num_rows > 0) {
                        // Loop through each row and display data in the table
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['orderID'] . "</td>
                                    <td>" . $row['customerID'] . "</td>
                                    <td>" . $row['brandID'] . "</td>
                                    <td>" . $row['status'] . "</td>
                                    <td>
                                      <a href='edit.php?orderID=" . $row['orderID'] . "'>Edit</a>

                                        <a href='deleteorder.php?orderID=" . $row['orderID'] . "' class='delete'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No orders found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Local Shop. All rights reserved.</p>
    </footer>
</body>
</html>