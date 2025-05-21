<?php
require_once 'PRODUCT.php';
require_once 'crudproduct.php';
require_once 'connect.php';

$action = $_GET['action'] ?? null;

if ($action === 'create') {
    $newProduct = new Product(null, "Test Product", "Test Desc", 55.50, 1, 2, "In Stock", "img/test.jpg");
    echo createProduct($conn, $newProduct);

} elseif ($action === 'read') {
    $id = $_GET['id'] ?? 1;
    $data = readProduct($conn, $id);
    echo "<pre>" . print_r($data, true) . "</pre>";

} elseif ($action === 'update') {
    $updatedProduct = new Product($_GET['id'], "Updated Name", "Updated Desc", 88.99, 1, 2, "Out of Stock", "img/updated.jpg");
    echo updateProduct($conn, $updatedProduct);

} elseif ($action === 'delete') {
    $id = $_GET['id'] ?? 0;
    echo deleteProduct($conn, $id);

} else {
    echo "No action selected. Use ?action=create, read, update&id=, or delete&id=";
}

$conn->close();
?>
