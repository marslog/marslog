<?php
session_start();

// ใช้ path ตรงไปยังไฟล์ users.json
$usersFile = __DIR__ . '/data/users.json';

// ตรวจสอบว่าไฟล์มีอยู่จริง
if (!file_exists($usersFile)) {
    header("Location: login.php?error=db");
    exit;
}

// โหลดข้อมูล JSON
$usersData = json_decode(file_get_contents($usersFile), true);
$users = $usersData['users'] ?? [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $authenticated = false;

    foreach ($users as $user) {
        // ตรวจสอบ username และ password โดยใช้ password_verify (hash)
        if (
            $user['username'] === $username &&
            password_verify($password, $user['password'])
        ) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = strtolower($user['role']);
            $authenticated = true;
            break;
        }
    }

    if ($authenticated) {
        // redirect ตาม role
        header("Location: " . ($_SESSION['role'] === 'admin' ? 'dashboard_admin.php' : 'dashboard_user.php'));
        exit;
    } else {
        // รหัสผ่านหรือชื่อผู้ใช้ไม่ถูกต้อง
        header("Location: login.php?error=invalid");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
