<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NACOM Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Remix Icon CDN (for ri-shield-user-line icon) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-shield-user-line text-white text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">NACOM || Login</h2>
            <p class="text-gray-600 mt-2">Access the admin || manager || suport dashboard</p>
        </div>

        <form class="space-y-6" action="../../api/auth/login.php" method="POST">

            <!-- Show message -->
            <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-error text-center text-sm p-2 rounded bg-red-100 text-red-800">
                <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
            <?php endif; ?>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="text" id="email" name="email"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter your email" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter password" />
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 font-semibold transition-colors whitespace-nowrap cursor-pointer">
                Login
            </button>
        </form>


        <div class="text-center mt-6">
            <a href="../../public/index.php" class="text-blue-600 hover:text-blue-700 text-sm cursor-pointer">
                ← Back to Website
            </a>
        </div>
    </div>
</body>

</html>