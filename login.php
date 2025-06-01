<?php
session_start();
$usersFile = __DIR__ . '/../data/users.json';
$users = json_decode(file_get_contents($usersFile), true)['users'] ?? [];

function verifyUser($username, $password, $users) {
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, password_hash($user['password'], PASSWORD_DEFAULT))) {
            return $user;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUser = $_POST['username'];
    $inputPass = $_POST['password'];
    $authenticated = verifyUser($inputUser, $inputPass, $users);

    if ($authenticated) {
        $_SESSION['username'] = $authenticated['username'];
        $_SESSION['role'] = $authenticated['role'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - MARSLOG</title>
  <link rel="stylesheet" href="assets/css/tailwind.min.css">
  <style>
    body {
      background-image: url('assets/img/b732da42-3d3b-476a-8be5-100a8dcb10b2.png');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="h-screen w-screen flex items-center justify-center">
  <div class="flex bg-white bg-opacity-10 backdrop-blur-lg rounded-lg shadow-lg w-[700px]">
    <div class="w-1/2 p-6 flex items-center justify-center">
      <img src="assets/img/marslogs-logo.png" class="w-40 h-40" alt="MARSLOG">
    </div>
    <form method="POST" class="w-1/2 bg-gray-800 p-8 rounded-r-lg text-white">
      <h2 class="text-2xl font-bold mb-4 text-center">MARSLOG Login</h2>
      <?php if (!empty($error)) echo "<p class='text-red-400 text-sm mb-4'>$error</p>"; ?>
      <input type="text" name="username" placeholder="Username" class="w-full mb-3 p-2 rounded bg-gray-700" required>
      <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 rounded bg-gray-700" required>
      <div class="flex justify-between items-center text-sm mb-4">
        <label><input type="checkbox"> Remember me</label>
        <a href="#" class="text-blue-400">Forgot Password?</a>
      </div>
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 p-2 rounded font-semibold">LOGIN</button>
    </form>
  </div>
</body>
</html>