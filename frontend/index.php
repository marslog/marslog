<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MARSLOG Dashboard</title>
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/tailwind.min.css">
</head>
<body class="bg-gray-900 text-white font-sans">
  <div class="container mx-auto p-4">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold">MARSLOG Dashboard</h1>
      <img src="assets/img/marslogs-logo.png" alt="MARSLOG Logo" class="h-12">
    </div>
    <div class="grid grid-cols-3 gap-6">
      <?php
      $features = [
        ["Log Ingestion", "Syslog · Marslog"],
        ["Monitoring", "SNMP · Dashboard"],
        ["User Access", "Login & Role-Based"],
        ["AI Analysis", "Anomaly Detection"],
        ["Alerts", "Email · LINE Notify"],
        ["Agent", "Marslog Installer"],
        ["Reporting", "PDF · Excel Export"],
        ["Archive", "Data Retention"],
        ["AI Chatbot", "Interactive Q&A"]
      ];
      foreach ($features as $feature) {
        echo '<div class="bg-gray-800 p-4 rounded shadow hover:bg-gray-700 transition">';
        echo '<h2 class="text-xl font-semibold mb-1">' . $feature[0] . '</h2>';
        echo '<p class="text-gray-400 text-sm">' . $feature[1] . '</p>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</body>
</html>