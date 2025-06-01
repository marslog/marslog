<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MARSLOGS</title>
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: url('assets/img/image.png') no-repeat center center fixed;
      background-size: cover;
    }
    .overlay {
      background: rgba(0, 0, 0, 0.75);
    }
  </style>
</head>
<body class="h-screen w-screen relative font-sans">
  <!-- Overlay -->
  <div class="overlay w-full h-full absolute top-0 left-0 z-0"></div>

  <!-- Login Form -->
  <div class="flex justify-center items-center h-full relative z-10">
    <form action="process_login.php" method="POST" class="bg-gray-900 bg-opacity-90 p-8 rounded-xl shadow-2xl w-full max-w-md">
      <div class="flex justify-center mb-6">
        <img src="assets/img/MARSLOGS_no_bg.png" alt="MARSLOGS Logo" class="w-16 h-16 rounded-full bg-white p-1">
      </div>

      <h1 class="text-2xl font-bold mb-6 text-center text-blue-400 tracking-wide">MARSLOGS</h1>

      <!-- Username -->
      <div class="mb-4">
        <label class="block mb-1 text-sm font-semibold text-white">Username</label>
        <input type="text" name="username" placeholder="Enter your username"
          class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label class="block mb-1 text-sm font-semibold text-white">Password</label>
        <input type="password" name="password" placeholder="Enter your password"
          class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Login Button -->
      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded transition duration-300">
        Login
      </button>

      <!-- Forgot -->
      <div class="text-center mt-3">
        <a href="#" class="text-sm text-blue-300 hover:underline">Forgot Password?</a>
      </div>

      <!-- Footer -->
      <p class="text-xs text-gray-400 mt-6 text-center">© 2024 MARSLOGS | All Rights Reserved</p>
    </form>
  </div>
</body>
</html>
