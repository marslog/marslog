<?php
session_start();

$usersFile = realpath(__DIR__ . '/../data/users.json'); // ✅ ตรงโฟลเดอร์จริง
if (!$usersFile || !file_exists($usersFile)) {
    header("Location: login.php?error=db");
    exit;
}

$usersData = json_decode(file_get_contents($usersFile), true);
$users = $usersData['users'] ?? [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $authenticated = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && (
            $password === $user['password'] || password_verify($password, $user['password'])
        )) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $authenticated = true;
            break;
        }
    }

    if ($authenticated) {
        if ($_SESSION['role'] === 'admin') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_user.php");
        }
        exit;
    } else {
        header("Location: login.php?error=invalid");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
