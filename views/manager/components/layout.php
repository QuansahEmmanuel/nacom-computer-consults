<!-- Loading Spinner -->
<div id="loading" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="text-center">
        <div
            class="w-16 h-16 border-4 border-blue-500 border-t-transparent border-solid rounded-full animate-spin mx-auto">
        </div>
        <p class="mt-4 text-gray-700 font-medium"></p>
    </div>
</div>


<?php
include __DIR__ . '/header.php';
// Start the main container
echo "<div class='flex min-h-screen'>";

// Include sidebar
include __DIR__ . '/sidebar.php';

// Start main content area
echo "<div class='flex-1'>";

// Include header
include __DIR__ . '/navbar.php';

// Main content wrapper
echo "<main class='p-6 bg-gray-50'>";

$page = $_GET['page'] ?? 'dashboard'; // default: dashboard

switch ($page) {
    case 'bookings':
        include __DIR__ . '/../pages/bookings.php';
        break;
    case 'user_management':
        include __DIR__ . '/../pages/userManagement.php';
        break;
    case 'enquiries':
        include __DIR__ . '/../pages/enquiries.php';
        break;
    case 'services':
        include __DIR__ . '/../pages/services.php';
        break;
    case 'reports':
        include __DIR__ . '/../pages/reports.php';
        break;
        case 'settings':
        include __DIR__ . '/../pages/settings.php';
        break;
    default:
        include __DIR__ . '/../pages/dashboard.php';
        break;
}

echo "</main>";
echo "</div>"; // End main content area
echo "</div>"; // End main container

include __DIR__ . '/footer.php';
?>