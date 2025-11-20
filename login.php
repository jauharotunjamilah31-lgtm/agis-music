<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-100">

    <div class="w-full max-w-xs">
        <form action="login.php" method="POST" class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <button type="submit" name="login" class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Login</button>
        </form>

        <?php
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['username'] = $user['username'];
                    header('Location: dashboard.php');
                } else {
                    echo "<p class='mt-4 text-center text-red-500'>Incorrect password.</p>";
                }
            } else {
                echo "<p class='mt-4 text-center text-red-500'>User not found.</p>";
            }
        }
        ?>
    </div>

</body>
</html>
