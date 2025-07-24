<?php
// sidebar.php
$page = $_GET['page'] ?? 'dashboard'; // Get current page from URL, default to 'dashboard'

// Helper function to dynamically assign active class
function nav_link_classes($currentPage, $targetPage) {
    return ($currentPage === $targetPage) 
        ? 'flex items-center px-4 py-3 rounded-lg text-white bg-gray-700' 
        : 'flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors';
}
?>

<!-- Hamburger Button (Mobile Only) -->
<button id="hamburgerBtn"
    class="lg:hidden fixed top-4 left-4 z-50 bg-gray-800 text-white p-3 rounded-lg shadow-lg hover:bg-gray-700 transition-colors">
    <i class="fas fa-bars text-lg"></i>
</button>

<!-- Overlay (Mobile Only) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar"
    class="w-64 bg-gray-600 text-white fixed lg:relative h-full lg:h-screen z-50 -translate-x-full lg:translate-x-0 transform transition-transform duration-300 ease-in-out">
    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-computer text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-white font-bold text-xl">NACOM</h1>
                <p class="text-gray-400 text-sm">Manager Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-8 px-4">
        <ul class="space-y-2">

            <!-- Dashboard -->
            <li>
                <a href="index.php?page=dashboard" class="<?= nav_link_classes($page, 'dashboard') ?>">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i> Dashboard
                </a>
            </li>

            <!-- User Management -->
            <li>
                <a href="index.php?page=user_management" class="<?= nav_link_classes($page, 'user_management') ?>">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i> User Management
                </a>
            </li>

            <!-- Bookings -->
            <li>
                <a href="index.php?page=bookings" class="<?= nav_link_classes($page, 'bookings') ?>">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i> Bookings
                </a>
            </li>


            <!-- Enquiries -->
            <li>
                <a href="index.php?page=enquiries" class="<?= nav_link_classes($page, 'enquiries') ?>">
                    <i class="fas fa-question-circle w-5 h-5 mr-3"></i> Enquiries
                </a>
            </li>

            <!-- Services -->
            <li>
                <a href="index.php?page=services" class="<?= nav_link_classes($page, 'services') ?>">
                    <i class="fas fa-cog w-5 h-5 mr-3"></i> Services
                </a>
            </li>

            <!-- Reports -->
            <li>
                <a href="index.php?page=reports" class="<?= nav_link_classes($page, 'reports') ?>">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i> Reports
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a href="index.php?page=settings" class="<?= nav_link_classes($page, 'settings') ?>">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i> System Settings
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout -->
    <div class="absolute bottom-4 left-4 right-4">
        <a href="logout.php"
            class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
            <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i> Logout
        </a>
    </div>
</aside>

<!-- Sidebar Toggle Script -->
<script>
const hamburgerBtn = document.getElementById('hamburgerBtn');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

let sidebarOpen = false;

hamburgerBtn.addEventListener('click', () => {
    sidebarOpen = !sidebarOpen;

    if (sidebarOpen) {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    } else {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
});

// Close sidebar when clicking overlay
overlay.addEventListener('click', () => {
    if (sidebarOpen) hamburgerBtn.click();
});

// Close sidebar on desktop resize
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024 && sidebarOpen) {
        sidebarOpen = false;
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
});
</script>