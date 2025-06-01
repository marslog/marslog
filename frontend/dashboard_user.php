<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard - MARSLOGS</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white min-h-screen">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 p-6 space-y-6">
      <h1 class="text-2xl font-bold text-blue-400">MARSLOGS User</h1>
      <nav class="space-y-2">
        <a href="#" class="block text-white hover:text-blue-400">My Logs</a>
        <a href="#" class="block text-white hover:text-blue-400">My Monitoring</a>
        <a href="logout.php" class="block text-red-400 mt-4">Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
      <h2 class="text-3xl font-semibold mb-4">Welcome <?php echo $_SESSION['username']; ?></h2>

      <!-- Tabs -->
      <div class="mb-6">
        <ul class="flex space-x-4 border-b border-gray-700">
          <li><a href="#" class="py-2 px-4 text-blue-400 border-b-2 border-blue-400">Logs</a></li>
          <li><a href="#" class="py-2 px-4 text-gray-300 hover:text-blue-300">Monitoring</a></li>
        </ul>
      </div>

      <!-- Example User Logs -->
      <div class="bg-gray-800 p-4 rounded-lg shadow">
        <h3 class="text-xl font-bold text-blue-300 mb-2">Your Logs</h3>
        <div class="text-sm text-gray-400">You have 24 new log entries today.</div>
      </div>

      <!-- Example Monitoring (basic) -->
      <div class="bg-gray-800 p-4 mt-8 rounded-lg shadow">
        <h3 class="text-xl font-bold text-green-300 mb-2">Device Status</h3>
        <table class="w-full text-left text-sm">
          <thead>
            <tr class="text-gray-400 border-b border-gray-600">
              <th class="py-2">Device</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b border-gray-700">
              <td class="py-2">My PC</td>
              <td class="text-green-400">Online</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="py-2">NAS QNAP</td>
              <td class="text-red-400">Offline</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
