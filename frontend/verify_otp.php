<?php
session_start();
require_once 'libs/TwoFactorAuth.php';  // ไลบรารีแบบ local

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$usersFile = __DIR__ . '/../data/users.json';
$users = json_decode(file_get_contents($usersFile), true)['users'];

$user = null;
foreach ($users as $u) {
    if ($u['username'] === $username) {
        $user = $u;
        break;
    }
}

if (!$user || empty($user['2fa_secret'])) {
    header("Location: index.php");
    exit;
}

$tfa = new TwoFactorAuth('MARSLOG');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];
    if ($tfa->verifyCode($user['2fa_secret'], $otp)) {
        $_SESSION['authenticated_2fa'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid OTP!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>2FA Verification</title>
    <link rel="stylesheet" href="assets/css/tailwind.min.css">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <form method="POST" class="bg-gray-800 p-6 rounded shadow-lg w-80 space-y-4">
        <img src="assets/img/marslogs-logo.png" class="mx-auto h-12" alt="MARSLOG">
        <h2 class="text-xl text-center font-bold">Two-Factor Auth</h2>
        <?php if (!empty($error)) echo "<p class='text-red-500 text-sm'>$error</p>"; ?>
        <input type="text" name="otp" placeholder="Enter OTP" class="w-full p-2 rounded bg-gray-700 text-white" required>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 p-2 rounded">Verify</button>
    </form>
</body>
</html>
