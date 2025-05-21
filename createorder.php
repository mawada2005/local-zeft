<?php
require_once "connect.php";

$customerID = $brandID = $status = "";
$customerID_err = $brandID_err = $status_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_customerID = trim($_POST["customerID"]);
    $input_brandID = trim($_POST["brandID"]);
    $input_status = trim($_POST["status"]);

    if (empty($input_customerID) || !ctype_digit($input_customerID)) {
        $customerID_err = "Invalid customer ID";
    } else {
        $customerID = $input_customerID;
    }

    if (empty($input_brandID) || !ctype_digit($input_brandID)) {
        $brandID_err = "Invalid brand ID";
    } else {
        $brandID = $input_brandID;
    }

    if (empty($input_status)) {
        $status_err = "Please select a status";
    } else {
        $status = $input_status;
    }

    if (empty($customerID_err) && empty($brandID_err) && empty($status_err)) {
        $sql = "INSERT INTO orders (customerID, brandID, status) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iis", $customerID, $brandID, $status);

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: create.php");
                exit();
            } else {
                echo "Execute failed: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    } else {
        echo "Validation error(s):<br>";
        echo $customerID_err . "<br>" . $brandID_err . "<br>" . $status_err;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
