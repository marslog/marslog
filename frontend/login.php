<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARSLOGS</title>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link href="tailwind.min.css" rel="stylesheet">

    <style>
        body {
            background: url('assets/img/image.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body class="h-screen w-screen relative">

    <!-- Menu Bar -->
    <div class="absolute top-0 left-0 w-full bg-gray-900 p-3 flex justify-between items-center z-20">
        <span class="text-white text-lg font-semibold ml-4">Welcome to MARSLOGS</span>
        <img src="assets/img/MARSLOGS.png" alt="MARSLOGS Logo" class="w-12 h-12 mr-4">
    </div>

    <!-- Overlay Background -->
    <div class="overlay w-full h-full absolute top-0 left-0 z-0"></div>

    <!-- Login Form -->
    <div class="flex justify-center items-center h-full relative z-10">
        <form action="process_login.php" method="POST" class="bg-gray-800 p-8 rounded shadow-lg w-full max-w-md">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="assets/img/MARSLOGS_no_bg.png" alt="MARSLOGS Logo" class="w-20 h-20">
            </div>
 
            <h1 class="text-3xl font-bold mb-6 text-center text-blue-400">MARSLOGS</h1>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-white">Username</label>
                <input type="text" name="username" placeholder="Enter your username"
                    class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-white">Password</label>
                <input type="password" name="password" placeholder="Enter your password"
                    class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded transition duration-300">
                Login
            </button>

            <p class="text-sm text-gray-400 mt-4 text-center">© 2024 MARSLOGS | All Rights Reserved</p>
        </form>
    </div>
</body>
</html>
