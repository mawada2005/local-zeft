<?php
// admin_actions.php

session_start();
require_once 'connect.php'; // يفترض أنه يعرف $conn




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {

        // 1. إضافة ماركة جديدة
        case 'add_brand':
            $brand_id = $_POST['brand_id'] ?? '';
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $owner_id = $_POST['owner_id'] ?? '';
            $logo = $_POST['logo'] ?? '';
            $category_id = $_POST['category_id'] ?? '';

            // تأكد أن brand_id غير مكرر
            $checkQuery = "SELECT brandID FROM brands WHERE brandID = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("s", $brand_id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                $_SESSION['error'] = "❌ رقم الماركة (ID) '$brand_id' موجود مسبقًا. رجاءً اختر رقم آخر.";
                header("Location: admin_dashboard.php");
                exit();
            }

            // تنفيذ الإدخال بعد التأكد
            $query = "INSERT INTO brands (brandID, brandName, description, ownerID, logoURL, categoryID)
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $brand_id, $name, $description, $owner_id, $logo, $category_id);

            if ($stmt->execute()) {
                $_SESSION['success'] = "✅ تم إضافة الماركة بنجاح!";
            } else {
                $_SESSION['error'] = "❌ فشل في إضافة الماركة: " . $stmt->error;
            }

            header("Location: admin_dashboard.php");
            exit();

        // 2. حذف ماركة
        case 'delete_brand':
            $brand_id = $_POST['brand_id'] ?? '';

            $query = "DELETE FROM brands WHERE brandID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $brand_id);

            if ($stmt->execute()) {
                $_SESSION['success'] = "🗑️ تم حذف الماركة بنجاح.";
            } else {
                $_SESSION['error'] = "❌ فشل في حذف الماركة: " . $stmt->error;
            }

            header("Location: admin_dashboard.php");
            exit();

        // 3. تعديل بيانات مستخدم (مثال مبدئي)
        case 'update_user':
            $userID = $_POST['userID'] ?? '';
            $_SESSION['info'] = "⚙️ جاري تحديث معلومات المستخدم برقم ID: $userID";
            header("Location: admin_dashboard.php");
            exit();

        // 4. إرسال إشعار
        case 'send_notification':
            $message = $_POST['message'] ?? '';
            $_SESSION['success'] = "📢 تم إرسال الإشعار: $message";
            header("Location: admin_dashboard.php");
            exit();

        // 5. استخراج تقرير النظام
        case 'get_system_report':
            $_SESSION['info'] = "📊 تم توليد تقرير النظام (مثال)";
            header("Location: admin_dashboard.php");
            exit();

        // خطأ في الطلب
        default:
            $_SESSION['error'] = "❗ الإجراء غير معروف.";
            header("Location: admin_dashboard.php");
            exit();
    }

} else {
    $_SESSION['error'] = "❗ الطلب غير صالح.";
    header("Location: admin_dashboard.php");
    exit();
}
?>
