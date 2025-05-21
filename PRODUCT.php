<?php
 require_once 'C:\wamp64\www\local-shop11\Models\connect.php';
class Product {
    private $productID;
    private $name;
    private $description;
    private $price;
    private $brandID;
    private $categoryID;
    private $stockStatus;
    private $imageURL;

    public function __construct($conn,$productID, $name, $description, $price, $brandID, $categoryID, $stockStatus, $imageURL) {
        $this->productID = $productID;
        $this->conn=$conn;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->brandID = $brandID;
        $this->categoryID = $categoryID;
        $this->stockStatus = $stockStatus;
        $this->imageURL = $imageURL;
    }

    public function viewDetails() {
        return [
            "productID" => $this->productID,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "brandID" => $this->brandID,
            "categoryID" => $this->categoryID,
            "stockStatus" => $this->stockStatus,
            "imageURL" => $this->imageURL
        ];
    }

    public function getProductID() { return $this->productID; }
    public function getProductName() { return $this->name; }
    public function getPrice() { return $this->price; }
    public function getBrandID() { return $this->brandID; }
    public function getCategoryID() { return $this->categoryID; }
    public function getStockStatus() { return $this->stockStatus; }
    public function getImageURL() { return $this->imageURL; }
    public function getDescription() { return $this->description; }

    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setPrice($price) { $this->price = $price; }
    public function setBrandID($brandID) { $this->brandID = $brandID; }
    public function setCategoryID($categoryID) { $this->categoryID = $categoryID; }
    public function setStockStatus($status) { $this->stockStatus = $status; }
    public function setImageURL($url) { $this->imageURL = $url; }

    function getAllProducts($conn) {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}
function createProduct($conn, $product) {
    $sql = "INSERT INTO products (name, description, price, brandID, categoryID, stockStatus, imageURL)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiiss",
        $product->getProductName(),
        $product->getDescription(),
        $product->getPrice(),
        $product->getBrandID(),
        $product->getCategoryID(),
        $product->getStockStatus(),
        $product->getImageURL()
    );
    return $stmt->execute() ? "Product created!" : "Create failed: " . $stmt->error;
}




function readProduct($conn, $productID) {
    $sql = "SELECT * FROM products WHERE productID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function updateProduct($conn, $product) {
    $sql = "UPDATE products SET name=?, description=?, price=?, brandID=?, categoryID=?, stockStatus=?, imageURL=?
            WHERE productID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiissi",
        $product->getProductName(),
        $product->getDescription(),
        $product->getPrice(),
        $product->getBrandID(),
        $product->getCategoryID(),
        $product->getStockStatus(),
        $product->getImageURL(),
        $product->getProductID()
    );
    return $stmt->execute() ? "Product updated!" : "Update failed: " . $stmt->error;
}


function deleteProduct($conn, $productID) {
    $sql = "DELETE FROM products WHERE productID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    return $stmt->execute() ? "Product deleted!" : "Delete failed: " . $stmt->error;
}
}


?>
