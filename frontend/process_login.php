<?php
session_start();
require 'db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ค้นหาผู้ใช้ในฐานข้อมูล
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ตรวจสอบรหัสผ่านทั้งแบบ Plain Text และ Hash
        if ($password === $user['password'] || password_verify($password, $user['password'])) {
            // ตั้งค่า Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // เปลี่ยนเส้นทางตาม Role
            switch ($user['role']) {
                case 'Admin':
                    header("Location: dashboard_admin.php");
                    break;
                case 'Editor':
                    header("Location: dashboard_editor.php");
                    break;
                case 'Viewer':
                    header("Location: dashboard_viewer.php");
                    break;
            }
            exit;
        } else {
            // รหัสผ่านไม่ถูกต้อง
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: index.html");
            exit;
        }
    } else {
        // ไม่พบผู้ใช้ในระบบ
        $_SESSION['error'] = "User not found.";
        header("Location: index.html");
        exit;
    }
} else {
    header("Location: index.html");
    exit;
}
?>
