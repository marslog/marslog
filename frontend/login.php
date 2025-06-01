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
      background-color: #1a1a1a;
    }
  </style>
</head>
<body class="flex items-center justify-center h-screen">
  <div class="flex w-[800px] rounded-2xl overflow-hidden shadow-lg">
    <div class="w-1/2 bg-cover bg-center text-white p-10 flex flex-col justify-end" style="background-image: url('assets/img/b83dbd31-fdce-401b-8148-cfa338e4c81f.png');">
      <div>
        <h2 class="text-2xl font-light">Be a Part of</h2>
        <h1 class="text-3xl font-bold">Something <span class="text-blue-400">Beautiful</span></h1>
      </div>
    </div>
    <form method="POST" class="w-1/2 bg-black p-10 text-white">
      <h2 class="text-2xl font-bold mb-2">Login</h2>
      <p class="text-gray-400 mb-6 text-sm">Enter your credentials to access your account</p>
      <?php if (!empty($error)) echo "<p class='text-red-400 text-sm mb-4'>$error</p>"; ?>
      <label class="block mb-2 text-sm">Email</label>
      <input type="text" name="username" class="w-full mb-4 p-2 rounded bg-gray-800 text-white" placeholder="you@example.com" required>
      <label class="block mb-2 text-sm">Password</label>
      <input type="password" name="password" class="w-full mb-4 p-2 rounded bg-gray-800 text-white" placeholder="********" required>
      <div class="flex justify-between items-center text-sm mb-6">
        <label><input type="checkbox" class="mr-2">Remember me</label>
      </div>
      <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 rounded">Login</button>
      <p class="mt-4 text-sm text-center text-gray-400">Not a member? <a href="#" class="text-yellow-400 font-medium">Create an account</a></p>
    </form>
  </div>
</body>
</html>
