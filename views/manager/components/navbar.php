<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get user info from session
$username = $_SESSION['username'] ?? 'User';
$role = $_SESSION['role'] ?? '';
$initial = strtoupper($username[0] ?? 'U');
?>

<nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 z-30">
    <div class="flex justify-between items-center">
        <!-- Page Title -->
        <div class="flex items-center">
            <h2 class="text-2xl font-bold ps-12 pb-2 text-gray-800" id="page-title">Dashboard Overview</h2>
        </div>

        <!-- Right Side (Notifications + User) -->
        <div class="flex items-center space-x-6">
            <!-- Notifications -->
            <div class="relative">
                <i class="fas fa-bell text-gray-500 text-xl cursor-pointer"></i>
                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
            </div>

            <!-- User Info -->
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold"><?php echo htmlspecialchars($initial); ?></span>
                </div>
                <div class="hidden sm:block text-gray-700 font-medium">
                    <span><?php echo htmlspecialchars($username); ?></span>
                    <span class="block text-xs text-gray-500"><?php echo htmlspecialchars(ucfirst($role)); ?></span>
                </div>
            </div>
        </div>
    </div>
</nav>