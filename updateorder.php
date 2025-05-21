<?php
ob_start(); // Start output buffering

require_once "connect.php";

$customerID = $brandID = $status = "";
$customerID_err = $brandID_err = $status_err = "";

if (isset($_POST["orderID"]) && !empty($_POST["orderID"])) {
    $orderID = $_POST["orderID"];

    // Validate customerID
    $input_customerID = trim($_POST["customerID"]);
    if (empty($input_customerID) || !ctype_digit($input_customerID)) {
        $customerID_err = "Please enter a valid customer ID.";
    } else {
        $customerID = $input_customerID;
    }

    // Validate brandID
    $input_brandID = trim($_POST["brandID"]);
    if (empty($input_brandID) || !ctype_digit($input_brandID)) {
        $brandID_err = "Please enter a valid brand ID.";
    } else {
        $brandID = $input_brandID;
    }

    // Validate status
    $input_status = trim($_POST["status"]);
    if (empty($input_status)) {
        $status_err = "Please enter the order status.";
    } else {
        $status = $input_status;
    }

    // If no errors, update the order
    if (empty($customerID_err) && empty($brandID_err) && empty($status_err)) {
        $sql = "UPDATE orders SET customerID=?, brandID=?, status=? WHERE orderID=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "iisi", $customerID, $brandID, $status, $orderID);

            if (mysqli_stmt_execute($stmt)) {
                // Redirect to create.php after success
                header("Location: create.php");
                exit();
            } else {
                echo "Error updating order. Please try again.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}

ob_end_flush(); // Send the output and stop buffering
?>
