<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - MARSLOGS</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white min-h-screen">
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Welcome Admin: <?php echo $_SESSION['username']; ?></h1>
    <p class="text-gray-300 mb-6">This is the admin dashboard with full access.</p>

    <!-- Example: Admin Panel Content -->
    <div class="bg-gray-800 p-6 rounded shadow">
      <h2 class="text-xl font-semibold mb-2">Admin Controls</h2>
      <ul class="list-disc list-inside text-gray-400">
        <li>Manage Users</li>
        <li>View Logs</li>
        <li>Configure System</li>
        <li>Monitor Alerts</li>
      </ul>
    </div>

    <div class="mt-6">
      <a href="logout.php" class="text-blue-400 hover:underline">Logout</a>
    </div>
  </div>
</body>
</html>
