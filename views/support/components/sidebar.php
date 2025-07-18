<?php
$page = $_GET['page'] ?? 'dashboard';

function nav_link_classes($currentPage, $targetPage) {
    return ($currentPage === $targetPage) 
        ? 'w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-white bg-gray-700 transition-colors cursor-pointer' 
        : 'w-full flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors cursor-pointer text-gray-600 hover:bg-blue-100';
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
    class="w-64 bg-white shadow-lg h-full lg:h-screen fixed lg:relative z-40 -translate-x-full lg:translate-x-0 transform transition-transform duration-300 ease-in-out flex-shrink-0">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-headset text-white text-lg"></i>
            </div>
            <div>
                <h2 class="font-bold text-xl text-gray-900">Support Panel</h2>
                <p class="text-gray-500 text-sm">NACOM Consults</p>
            </div>
        </div>
    </div>

    <nav class="p-4">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="index.php?page=dashboard" class="<?= nav_link_classes($page, 'dashboard') ?>">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="fa-solid fa-gauge text-lg"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            <!-- Enquiries -->
            <li>
                <a href="index.php?page=enquiries" class="<?= nav_link_classes($page, 'enquiries') ?>">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="fa-solid fa-circle-question text-lg"></i>
                    </div>
                    <span class="font-medium">Enquiries Response</span>
                </a>
            </li>

            <!-- Bookings -->
            <li>
                <a href="index.php?page=bookings" class="<?= nav_link_classes($page, 'bookings') ?>">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="fa-solid fa-calendar-alt text-lg"></i>
                    </div>
                    <span class="font-medium">Booking Management</span>
                </a>
            </li>

            <!-- Services -->
            <li>
                <a href="index.php?page=services" class="<?= nav_link_classes($page, 'services') ?>">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <i class="fa-solid fa-screwdriver-wrench text-lg"></i>
                    </div>
                    <span class="font-medium">Services Support</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout -->
    <div class="absolute bottom-4 left-4 right-4">
        <button
            class="w-full flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-blue-100 rounded-lg transition-colors cursor-pointer">
            <div class="w-5 h-5 flex items-center justify-center">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
            </div>
            <span class="font-medium">Logout</span>
        </button>
    </div>
</aside>


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