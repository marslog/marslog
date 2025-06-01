<?php
session_start();
$usersFile = __DIR__ . '/../data/users.json';
if (!file_exists($usersFile)) {
    header("Location: login.php?error=db");
    exit;
}
$usersData = json_decode(file_get_contents($usersFile), true);
$users = $usersData['users'] ?? [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameInput = trim($_POST['username']);
    $passwordInput = trim($_POST['password']);
    $passwordInput = rtrim($passwordInput, "\r\n\t ");

    $authenticated = false;
    foreach ($users as $user) {
        if ($user['username'] === $usernameInput && password_verify($passwordInput, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = strtolower($user['role']);
            $authenticated = true;
            break;
        }
    }

    if ($authenticated) {
        header("Location: " . ($_SESSION['role'] === 'admin' ? 'dashboard_admin.php' : 'dashboard_user.php'));
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
