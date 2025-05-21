<?php
require 'connect.php'; 

interface Observer {
    public function update($message);
}

interface Subject {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify($message);
}

class NotificationManager implements Subject {
    private $observers = [];

    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer) {
        $this->observers = array_filter($this->observers, fn($obs) => $obs !== $observer);
    }

    public function notify($message) {
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
    }

    public function send($conn, $sender_id, $receiver_id, $message) {
        $stmt = $conn->prepare("INSERT INTO notifications (sender_id, receiver_id, message, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
        $stmt->execute();
        $stmt->close();

        $this->notify($message);
    }
}

class UserObserver implements Observer {
    private $userId;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    public function update($message) {
        // مكان فاضي لأن التنبيه محفوظ فعليًا في قاعدة البيانات
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $notifier = new NotificationManager();

    $sender_id = $_POST["sender_id"] ?? null;
    $receiver_id = $_POST["receiver_id"] ?? null;

    // ============= 1. إرسال رسالة عادية (خصم أو إشعار عام)
    if (isset($_POST["discountMessage"])) {
        $message = $_POST["discountMessage"];
        if ($message && $sender_id && $receiver_id) {
            $notifier->attach(new UserObserver($receiver_id));
            $notifier->send($conn, $sender_id, $receiver_id, $message);
            echo "<br>✅ Notification sent.";
        }
    }

    // ============= 2. تحديث حالة الطلب
    if (isset($_POST["order_id"]) && isset($_POST["order_status"])) {
        $order_id = $_POST["order_id"];
        $order_status = $_POST["order_status"];
        
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE orderID = ?");
        $stmt->bind_param("si", $order_status, $order_id);
        $stmt->execute();
        $stmt->close();

        $message = "Order #$order_id status updated to '$order_status'";
        $notifier->attach(new UserObserver($receiver_id));
        $notifier->send($conn, $sender_id, $receiver_id, $message);

        echo "<br>✅ Order status updated.";
    }

    // ============= 3. إعادة تعبئة المخزون
    if (isset($_POST["product_id"]) && isset($_POST["quantity"])) {
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];

        $stmt = $conn->prepare("UPDATE products SET stock = stock + ? WHERE productID = ?");
        $stmt->bind_param("ii", $quantity, $product_id);
        $stmt->execute();
        $stmt->close();

        $message = "Product #$product_id restocked with $quantity items.";
        $notifier->attach(new UserObserver($receiver_id));
        $notifier->send($conn, $sender_id, $receiver_id, $message);

        echo "<br>✅ Product restocked.";
    }
}
?>
