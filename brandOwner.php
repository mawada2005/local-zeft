<?php
require_once("User.php");

class BrandOwner extends User {

public function __construct($userID, $name, $email, $password){
            parent::__construct($userID, $name, $email, $password);
}

public function registerBrand() {
    echo "BrandOwner {$this->name} registered a new brand.<br>";
}

public function addProduct($productID) {
    echo "BrandOwner {$this->name} added product with ID: $productID<br>";
}

public function editProduct($productID) {
    echo "BrandOwner {$this->name} edited product with ID: $productID<br>";
}

public function deleteProduct($productID) {
    echo "BrandOwner {$this->name} deleted product with ID: $productID<br>";
}

public function viewStatistics() {
    echo "BrandOwner {$this->name} is viewing brand statistics.<br>";
}

public function manageProductBrand() {
    echo "BrandOwner {$this->name} is managing the product brand.<br>";
}

public function viewProduct() {
    echo "BrandOwner {$this->name} is viewing a product.<br>";
}
}
?>