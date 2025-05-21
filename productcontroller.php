<?php
require_once 'C:\wamp64\www\(Local-shop)\Models\PRODUCT.php';
require_once  'C:\wamp64\www\(Local-shop)\connect.php';

class ProductController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   
    public function create($data) {
        $product = new Product(
            $this->conn,
            null,
            $data['name'],
            $data['description'],
            $data['price'],
            $data['brandID'],
            $data['categoryID'],
            $data['stockStatus'],
            $data['imageURL']
        );
        return $product->createProduct($this->conn, $product);
    }
    public function add()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['productName'];
        $price = $_POST['productPrice'];
        $category = $_POST['productCategory'];

        $imageName = $_FILES['productImage']['name'];
        $imageTmp = $_FILES['productImage']['tmp_name'];
        $imagePath = "uploads/" . basename($imageName);
        move_uploaded_file($imageTmp, $imagePath);

        require_once 'models/Product.php';
        $productModel = new Product();
        $productModel->addProduct($name, $price, $category, $imagePath);

        header("Location: index.php?controller=Dashboard&action=index");
        exit;
    }

    require_once 'views/add_product.php'; // صفحة الفورم
}


    
    public function read($productID) {
        $product = new Product($this->conn, null, "", "", 0, 0, 0, "", "");
        return $product->readProduct($this->conn, $productID);
    }

    
    public function update($data) {
        $product = new Product(
            $this->conn,
            $data['productID'],
            $data['name'],
            $data['description'],
            $data['price'],
            $data['brandID'],
            $data['categoryID'],
            $data['stockStatus'],
            $data['imageURL']
        );
        return $product->updateProduct($this->conn, $product);
    }

   
    public function delete($productID) {
        $product = new Product($this->conn, null, "", "", 0, 0, 0, "", "");
        return $product->deleteProduct($this->conn, $productID);
    }

   
    public function list() {
        $product = new Product($this->conn, null, "", "", 0, 0, 0, "", "");
        return $product->getAllProducts($this->conn);
    }
}
?>
