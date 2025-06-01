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
</head>
<body>
  <div class="bg-cover bg-gradient-to-br from-[#7337FF] via-[#000000] to-[#0C7EA8]" style="background-image:url('assets/img/8b0bfc19-ee5b-4fe3-8f2b-4781af82efef.png')">
    <div class="h-screen flex justify-center items-center backdrop-brightness-50">
      <div class="flex flex-col items-center space-y-8">
        <div>
          <img src="assets/img/marslogs-logo.png" alt="Marslog Logo" class="w-20 h-20 cursor-pointer" />
        </div>
        <form method="POST" class="rounded-[20px] w-80 p-8 bg-[#310D84] shadow-md" style="box-shadow:-6px 3px 20px 4px #0000007d">
          <h1 class="text-white text-3xl font-bold mb-4">Login</h1>
          <?php if (!empty($error)) echo "<p class='text-red-400 text-sm mb-4'>$error</p>"; ?>
          <div class="space-y-4">
            <input type="text" name="username" placeholder="Email address" class="bg-[#8777BA] w-full p-2.5 rounded-md placeholder:text-gray-300 shadow-md shadow-blue-950" required />
            <input type="password" name="password" placeholder="Password" class="bg-[#8777BA] w-full p-2.5 rounded-md placeholder:text-gray-300 shadow-md shadow-blue-950" required />
          </div>
          <div class="mb-4">
            <a href="forgot_password.php" class="text-[#228CE0] text-[10px] ml-2 cursor-pointer">Forget Password?</a>
          </div>
          <div class="flex justify-center mb-4">
            <button type="submit" class="h-10 w-full cursor-pointer text-white rounded-md bg-gradient-to-br from-[#7336FF] to-[#3269FF] shadow-md shadow-blue-950">
              Sign In
            </button>
          </div>
          <div class="text-gray-300 text-center text-sm">
            Don’t have an account?
            <a href="register.php" class="text-[#228CE0] underline cursor-pointer">Sign up</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
