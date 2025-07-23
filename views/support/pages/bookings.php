<div class="container mx-auto p-4">
  <h2 class="text-2xl font-bold text-gray-800 mb-6">Assigned Bookings</h2>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Filter Section -->
    <div class="bg-white shadow-md rounded-lg p-5">
      <h3 class="text-lg font-semibold mb-4 text-gray-800">Filter Bookings</h3>

      <!-- Status Filter -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Status:</label>
        <select class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">All</option>
          <option value="pending">Pending</option>
          <option value="confirmed">Confirmed</option>
          <option value="completed">Completed</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>

      <!-- Date Range Filter -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Date Range:</label>
        <div class="flex space-x-2">
          <input type="date" class="w-1/2 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          <input type="date" class="w-1/2 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
      </div>

      <!-- Search Filter -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Search:</label>
        <div class="flex">
          <input type="text" placeholder="Booking ID, Name..." class="w-full border border-gray-300 rounded-l px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          <button class="bg-blue-600 text-white px-4 py-2 text-sm font-semibold rounded-r hover:bg-blue-700">Search</button>
        </div>
      </div>
    </div>

    <!-- Booking Table -->
    <div class="md:col-span-3 bg-white shadow-md rounded-lg p-5 overflow-x-auto">
      <table class="w-full text-sm text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 text-gray-700">
            <th class="px-4 py-2 font-semibold">Booking ID</th>
            <th class="px-4 py-2 font-semibold">Client Name</th>
            <th class="px-4 py-2 font-semibold">Service</th>
            <th class="px-4 py-2 font-semibold">Booking Date</th>
            <th class="px-4 py-2 font-semibold">Status</th>
            <th class="px-4 py-2 font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-t">
            <td class="px-4 py-2">#12345</td>
            <td class="px-4 py-2">John Doe</td>
            <td class="px-4 py-2">IT Consultation</td>
            <td class="px-4 py-2">2025-07-20</td>
            <td class="px-4 py-2">
              <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">Confirmed</span>
            </td>
            <td class="px-4 py-2">
              <button class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 mr-2">View</button>
              <select class="text-sm border rounded px-2 py-1">
                <option disabled selected>Update Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </td>
          </tr>

          <tr class="border-t">
            <td class="px-4 py-2">#67890</td>
            <td class="px-4 py-2">Jane Smith</td>
            <td class="px-4 py-2">System Maintenance</td>
            <td class="px-4 py-2">2025-07-21</td>
            <td class="px-4 py-2">
              <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">Pending</span>
            </td>
            <td class="px-4 py-2">
              <button class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 mr-2">View</button>
              <select class="text-sm border rounded px-2 py-1">
                <option disabled selected>Update Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </td>
          </tr>

          <tr class="border-t">
            <td class="px-4 py-2">#ID</td>
            <td class="px-4 py-2">Client Name</td>
            <td class="px-4 py-2">Service</td>
            <td class="px-4 py-2">Date</td>
            <td class="px-4 py-2">
              <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">Status</span>
            </td>
            <td class="px-4 py-2">
              <button class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 mr-2">View</button>
              <select class="text-sm border rounded px-2 py-1">
                <option disabled selected>Update Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination -->
<div class="mt-6 flex justify-center">
  <nav class="inline-flex shadow-sm rounded-md" aria-label="Pagination" id="paginationNav">
    <button class="pagination-btn px-3 py-1 bg-blue-500 text-white border border-blue-500">1</button>
    <button class="pagination-btn px-3 py-1 bg-white border border-gray-300 hover:bg-gray-100">2</button>
    <button class="pagination-btn px-3 py-1 bg-white border border-gray-300 hover:bg-gray-100">3</button>
    <button class="pagination-btn px-3 py-1 bg-white border border-gray-300 text-gray-500 hover:bg-gray-100">»</button>
  </nav>
</div>

<script>
  const buttons = document.querySelectorAll('.pagination-btn');

  buttons.forEach(btn => {
    btn.addEventListener('click', function () {
      // Remove active class from all
      buttons.forEach(b => {
        b.classList.remove('bg-blue-500', 'text-white', 'border-blue-500');
        b.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
      });

      // Add active class to clicked
      this.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
      this.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
    });
  });
</script>
