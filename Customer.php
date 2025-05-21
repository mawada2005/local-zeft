<?php
require_once("User.php");

class Customer extends User {
    private $orders = [];
    private $favorites = [];
    private $paymentMethod;

    public function __construct($userID, $name, $email, $password) {
        parent::__construct($userID, $name, $email, $password);
    }

    
    public function signUp($user) {
        echo "{$this->name} signed up successfully.<br>";
    }

    public function searchProducts($Pname) {
        echo "{$this->name} searched for: $Pname<br>";
    }

    public function searchBrand($BrandID) {
        echo "{$this->name} searched for brand with ID: $BrandID<br>";
    }

    public function viewProduct($productID) {
        echo "{$this->name} is viewing product with ID: $productID<br>";
    }

    public function viewBrand($Bname) {
        echo "{$this->name} is viewing brand named: $Bname<br>";
    }

    public function placeOrder($OrderID, $BrandID) {
        echo "{$this->name} placed an order. Order ID: $OrderID, Brand ID: $BrandID<br>";
    }

    public function trackOrder($DeliveryID) {
        echo "{$this->name} is tracking order. Delivery personnel ID: $DeliveryID<br>";
    }

    public function makePayment($amount, $method) {
        echo "{$this->name} paid $amount EGP using $method<br>";
    }

    public function makeReview($productID, $rating, $comment) {
        echo "{$this->name} reviewed product $productID with rating $rating/5 and said: \"$comment\"<br>";
    }

    public function manageProfile() {
        echo "{$this->name} is managing their profile.<br>";
    }

    public function contactSupport($message) {
        echo "{$this->name} sent a message to support: \"$message\"<br>";
    }

    // ========== Order & Favorite ==========
    public function addOrder($order) {
        $this->orders[] = $order;
        echo "Order added for customer {$this->name}<br>";
    }

    public function getOrders() {
        return $this->orders;
    }

    public function addFavorite($product) {
        $this->favorites[] = $product;
        echo "Product added to favorites for customer {$this->name}<br>";
    }

    public function getFavorites() {
        return $this->favorites;
    }

    // ========== Payment Method ==========
    public function setPaymentMethod($paymentMethod) {
        $this->paymentMethod = $paymentMethod;
    }

    public function pay($amount) {
        if ($this->paymentMethod) {
            $this->paymentMethod->pay($amount);
        } else {
            echo "No payment method set for {$this->name}<br>";
        }
    }
}
?>
