<?php
session_start(); 
require_once 'C:\wamp64\www\local-shop11\Models\connect.php';
require_once 'C:\wamp64\www\local-shop11\Models\user.php';
require_once 'C:\wamp64\www\local-shop11\Models\product.php';
require_once 'session.php';
try {
    $pdo = new PDO('mysql:host=localhost;dbname=local_shop11', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST['email'];
        $password = $_POST['password']; 
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // ✅ حفظ البيانات في الـ SESSION
                $_SESSION['user_id'] = $user['userID'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_type'] = $user['user_type']; // لازم يكون عندك العمود ده في الجدول

                // ✅ التوجيه حسب نوع المستخدم
                switch ($user['user_type']) {
                    case 'admin':
                        header("Location: /admin/dashboard.php");
                        break;
                    case 'brand_owner':
                        header("Location: /local-shop11/Views/Dbrandowner.php");
                        break;
                    case 'delivery':
                        header("Location: /delivery/dashboard.php");
                        break;
                    default:
                        header("Location: /customer/home.php");
                        break;
                }
                exit;
            } else {
                echo "❌ Incorrect password!";
            }
        } else {
            echo "❌ No user found with that email!";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
