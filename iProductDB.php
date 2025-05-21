<?php

interface iProductDB {
    public function connectToDB();
    public function insertProduct($product);
    public function updateProduct($product);
    public function deleteProduct($productId);
}

class FakeProductDB implements iProductDB {

    public function connectToDB() {
        echo "Connected to Fake DB<br>";
    }

    public function insertProduct($product) {
        echo "Inserted product: " . $product->name . "<br>";
    }

    public function updateProduct($product) {
        echo "Updated product: " . $product->name . "<br>";
    }

    public function deleteProduct($productId) {
        echo "Deleted product with ID: " . $productId . "<br>";
    }
}
?>
