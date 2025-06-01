<?php
session_start();

// 📌 ใช้ path ตรงจากตำแหน่งไฟล์
$usersFile = __DIR__ . '/data/users.json';

// 🔒 ตรวจสอบว่ามีไฟล์ users.json จริง
if (!file_exists($usersFile)) {
    header("Location: login.php?error=db");
    exit;
}

// 🔄 อ่านข้อมูลผู้ใช้จาก JSON
$usersData = json_decode(file_get_contents($usersFile), true);
$users = $usersData['users'] ?? [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 🔐 กรอง username และ password
    $usernameInput = trim($_POST['username']);
    $passwordInput = trim($_POST['password']);
    $passwordInput = rtrim($passwordInput, "\r\n\t ");

    $authenticated = false;

    foreach ($users as $user) {
        // ✅ ตรวจสอบ username ตรงกัน
        if ($user['username'] === $usernameInput) {
            // 🔐 ตรวจสอบ password hash แบบปลอดภัย
            if (password_verify($passwordInput, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = strtolower($user['role']);
                $authenticated = true;
                break;
            }
        }
    }

    // ✅ เข้าระบบสำเร็จ
    if ($authenticated) {
        header("Location: " . ($_SESSION['role'] === 'admin' ? 'dashboard_admin.php' : 'dashboard_user.php'));
        exit;
    } else {
        // ❌ รหัสผ่านไม่ถูกต้อง
        header("Location: login.php?error=invalid");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
